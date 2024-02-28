<%

' based on Sample ASP code that uses CAS By Howard Gilbert
' Modifications made by Jay Sissom

' For the Web server to talk to the CAS server, this code depends on the
' Microsoft ServerXMLHTTP control provided with MSXML. If the MS XML
' parser is not already installed on the IIS host machine,
' download version 3.0 SP1 or better from http://www.microsoft.com/xml

Function CASCheckLogin(CASAppCode,RedirectURL)
   dim CAS_Server
   dim user
   dim ticket
   dim url
   dim oHttp
   dim resp
   dim respArray
   CAS_Server = "https://cas.iu.edu/cas/"
   user = Session.Contents("Netid")
   if user = "" then
      ' Check to see if we got a CAS ticket
      ticket = Request.QueryString.Item("casticket").Item

      if ticket = "" then
         ' Redirect to CAS for authentication
         url = CAS_Server + "login?cassvc=" + CASAppCode + "&casurl=" + RedirectURL
         Response.Redirect(url)
         Response.end
      else
         ' Validate the ticket
         set oHttp = Server.CreateObject("MSXML2.ServerXMLHTTP.4.0")
         url = CAS_Server + "validate?cassvc=" + CASAppCode + "&casticket=" + ticket + "&casurl=" + RedirectURL

         oHttp.open "GET",url,false
         oHttp.send

         resp = oHttp.responseText
            Session.Contents("Netid") = respArray(1)
         else
            ' Sorry, invalid ticket, so they don't get in
         end if
      end if
   else
      ' return the username
   end if
End Function

 %>