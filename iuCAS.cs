using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Net;
using System.IO;
using System.Web;
using System.Web.UI;

namespace YourNamespaceHere
{
    /// <summary>
    /// IU CAS object.
    /// problems?  e-mail: adajfraz@iu.edu
    /// 
    /// Implementation:  string username = iuCAS.CASAuth("https://yourappurl.iu.edu"); //returns null if invalid user
    ///                  string username = iuCAS.CASAuth(this.Page); //returns null if invalid user
    /// </summary>
    public class iuCAS 
    {
        private static string CAS_Server = "https://cas.iu.edu/cas/";
        private static string CAS_Method = "GET";
        private static string CAS_AppCode = "IU";
        
        /// <summary>
        /// Method used to authenticate against IU's CAS integration.  <c>null</c> if invalid user.  
        /// </summary>
        /// <param name="p">
        /// Page.  Page object you wish to return an authenticated user to.
        /// </param>
        /// <returns>
        /// string.  Username of authenticated CAS user.  <c>null</c> if user is invalid.
        /// </returns>
        public static string CASAuth(Page p)
        {
            string ServiceUrl = HttpUtility.UrlEncode(p.Request.Url.AbsoluteUri);
            return CASAuth(ServiceUrl);
        }

        /// <summary>
        /// Method used to authenticate against IU's CAS integration.  <c>null</c> if invalid user.  
        /// </summary>
        /// <param name="ServiceUrl">string.  Full URL of your application</param>
        /// <returns>
        /// string.  Username of authenticated CAS user.  <c>null</c> if user is invalid.
        /// </returns>
        public static string CASAuth(string ServiceUrl)
        {
            string ticket = null;
            string resp = null;
            
            if (HttpContext.Current.Session["netid"] != null)
                return HttpContext.Current.Session["netid"].ToString();

            if (HttpContext.Current.Request.QueryString["casticket"] == null)
                HttpContext.Current.Response.Redirect(CAS_Server + "login?cassvc=" + CAS_AppCode + "&casurl=" + ServiceUrl);

            //IF THIS FAR THERE'S A CASTICKET
            ticket = HttpContext.Current.Request.QueryString["casticket"].ToString();            

            // VALIDATE
            resp = GetResponse(string.Format("{0}?cassvc=IU&casticket={1}&casurl={2}", Path.Combine(CAS_Server, "validate"), ticket, ServiceUrl));

            //RETURN USERNAME OR NULL IF NO USER
            try  { 
                string validUsername = resp.Split('\n')[1].Split('\r')[0];
                string yesOrno = resp.Substring(0, resp.IndexOf("\r"));

                if (yesOrno == "no")
                    HttpContext.Current.Response.Redirect(CAS_Server + "login?cassvc=" + CAS_AppCode + "&casurl=" + ServiceUrl); //EXPIRED CASTICKET, LOGIN AGAIN

                HttpContext.Current.Session["netid"] = validUsername;
                HttpContext.Current.Session.Timeout = 45;
                return validUsername;
            }
            catch (Exception ex)
            {
                //if we had a problem somewhere above, throw up with some helpful data
                //throw new ValidateException(ticket, resp, ex);
                return null;                
            }

            
        }

        private static string GetResponse(string url)
        {
            //FIX TO USE AVAILABLE PROTOCOL
            ServicePointManager.SecurityProtocol = SecurityProtocolType.Ssl3 | SecurityProtocolType.Tls | SecurityProtocolType.Tls11 | SecurityProtocolType.Tls12;

            //split out IDisposables into seperate using blocks to ensure everything gets disposed
            using (WebClient c = new WebClient())
            using (Stream response = c.OpenRead(url))
            using (StreamReader reader = new StreamReader(response))
            {
                return reader.ReadToEnd();
            }
        }
    }
}
