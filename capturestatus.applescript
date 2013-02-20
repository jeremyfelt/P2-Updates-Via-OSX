(* This script will generate a dialog box for a status update,
   and then if something other than None is entered, a second 
   dialog box for a list of comma separated tags to be entered.
   Once the dialog boxes are complete, it calls a PHP script
   that takes care of the XMLRPC request for us. *)
display dialog "Do you have a status update to share?" default answer "Nope"
if text returned of the result is "Nope" then
	return -- If your status update is "Nope", you have problems.
else
	set statusUpdate to (text returned of result)
end if
display dialog "Do you have any comma separated tags to add?" default answer "Team Black"
set tagsUpdate to (text returned of result)
do shell script "php /Users/jeremyfelt/Development/tools/status-update.php \"" & statusUpdate & "\" \"" & tagsUpdate & "\""