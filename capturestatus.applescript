display dialog "Do you have a status update to share?" default answer "None"
set statusUpdate to (text returned of result)
display dialog "Do you have any tags to add?" default answer "None"
set tagsUpdate to (text returned of result)
display dialog "You are entering the status of - " & statusUpdate & " - while assigning tags - " & tagsUpdate & " - click ok to continue."
do shell script "php /Users/jeremyfelt/Development/tools/status-update.php \"" & statusUpdate & "\" \"" & tagsUpdate & "\""
