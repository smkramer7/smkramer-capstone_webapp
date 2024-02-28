using System;
using System.Collections;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Web;
using System.Web.SessionState;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.HtmlControls;
using System.Web.Security;
using System.IO;
using System.Net;

namespace SiteFramework
{
	/// <summary>
	/// Based on sample ASP code that uses CAS
	/// </summary>
	public class CASLogin : System.Web.UI.Page
	{
		public string CAS_Server = "https://cas.iu.edu/cas/";
		public string CAS_Method = "GET";
		public string CAS_AppCode = "IU";

		private void Page_Load(object sender, System.EventArgs e)
		{
			Uri MyUrl = Request.Url;
			string returnURL = MyUrl.Scheme + "://" + MyUrl.Host + MyUrl.AbsolutePath + "/Login.aspx";

			// Prevent caching, so can't be viewed offline
			Response.Cache.SetCacheability(HttpCacheability.NoCache);

			string user = CheckCASLogin(returnURL);
			if (user == "")
			{
				//redirect to login page
				RedirectToCASLogin(returnURL);
			}
			else
			{
				//user variable has the authenticated login id.
				FormsAuthentication.RedirectFromLoginPage(user,false,"/SiteFramework/Start.aspx");
				
				//FormsAuthentication.SetAuthCookie (user,false); 
				//true will last forever and false looks at time in web.config (1 will expire when browser closes)
				//Response.Redirect("Start.aspx", true);
			}
		}
		
		public void RedirectToCASLogin(string returnURL)
		{
			// Redirect to CAS for authentication
			string url = CAS_Server + "login?cassvc=" + CAS_AppCode + "&casurl=" + returnURL;
			//Response.Write(url);
			//Response.End();
			Response.Redirect(url, true);
		}

		public string CheckCASLogin(string returnURL)
		{
			string user = "";
			string ticket = "";
			string resp = "";
			string[] respArray;

			if (Session["netid"] != null) 
			{
				user = Session["netid"].ToString();
			}
			if (user == "")
			{
				// Check to see if we got a CAS ticket
				if (Request.QueryString["casticket"] != null)
				{
					ticket = Request.QueryString["casticket"].ToString();
				}
				else
				{
					if (Session["casticket"] != null) 
					{
						ticket = Session["casticket"].ToString();
					}
				}

				if (ticket == "")
				{
					return "";
				}
				else
				{
					// Validate the ticket
					HttpWebRequest httpWebRequest = (HttpWebRequest)WebRequest.Create(CAS_Server + "validate?" + "cassvc=" + Server.UrlEncode(CAS_AppCode) + "&casticket=" + ticket + "&casurl=" + returnURL);
					httpWebRequest.Method = CAS_Method;
					
					HttpWebResponse httpWebResponse = (HttpWebResponse)httpWebRequest.GetResponse();
		
					StreamReader streamReader = new StreamReader(httpWebResponse.GetResponseStream());
					resp = streamReader.ReadToEnd();
					streamReader.Close();

					respArray = resp.Split((char)13); //resp.Split((char)10);
					if (respArray[0].ToString().Trim() == "yes")
					{
						// Valid ticket, so get the network ID and save it in session
						Session["casticket"] = ticket;
						Session["netid"] = respArray[1].ToString().Trim();
						return respArray[1].ToString().Trim();
					}
					else
					{
						// Sorry, invalid ticket, so they don't get in
						return "";
					}
				}
			}
			else
			{
				// return the username
				return user;
			}
		}



		#region Web Form Designer generated code
		override protected void OnInit(EventArgs e)
		{
			//
			// CODEGEN: This call is required by the ASP.NET Web Form Designer.
			//
			InitializeComponent();
			base.OnInit(e);
		}
		
		/// <summary>
		/// Required method for Designer support - do not modify
		/// the contents of this method with the code editor.
		/// </summary>
		private void InitializeComponent()
		{    
			this.Load += new System.EventHandler(this.Page_Load);

		}
		#endregion
	}
}
