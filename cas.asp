<%

' based on Sample ASP code that uses CAS By Howard Gilbert
' Modifications made by Jay Sissom

' For the Web server to talk to the CAS server, this code depends on the
' Microsoft ServerXMLHTTP control provided with MSXML. If the MS XML
' parser is not already installed on the IIS host machine,
' download version 3.0 SP1 or better from http://www.microsoft.com/xml
' ================================================================' CASCheckLogin' This function will do all the interfacing with CAS using the Legacy' validation protocol.' Parameters:'   CASAppCode = Application Code for this app'   RedirectURL = Where the CAS server should redirect to get back to your'     application' Returns:'   Empty string = User didn't authenticate'   username = User did authentication properly' Notes:'   This doesn't handle POSTS through the CAS server like the apache module.'   It also won't deal with the QUERY_STRING properly if it needs to redirect.'   Both of these should be dealt with before calling this function' =================================================================
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

         resp = oHttp.responseText         respArray = Split(resp,chr(13)+chr(10))         if respArray(0) = "yes" then            ' Valid ticket, so get the network ID and save it in session
            Session.Contents("Netid") = respArray(1)            CASCheckLogin = respArray(1)
         else
            ' Sorry, invalid ticket, so they don't get in			CASCheckLogin = ""
         end if
      end if
   else
      ' return the username      CASCheckLogin = user
   end if
End Function

 %>
