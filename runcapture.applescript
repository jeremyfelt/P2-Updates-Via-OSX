(* The sole purpose of this file is to tell AppleScript Runner to load
   the other file that was passed as part of the argument. If we do not
   load the second script this way, the execution of the dialog box
   fails and the script silently dies. *)
on run {sourcefile}
	tell application "AppleScript Runner"
		do script sourcefile
	end tell
end run