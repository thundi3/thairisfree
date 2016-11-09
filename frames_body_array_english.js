
//The following line is critical for menu operation, and MUST APPEAR ONLY ONCE. If you have more than one menu_array.js file rem out this line in subsequent files
menunum=0;menus=new Array();_d=document;function addmenu(){menunum++;menus[menunum]=menu;}function dumpmenus(){mt="<script language=javascript>";for(a=1;a<menus.length;a++){mt+=" menu"+a+"=menus["+a+"];"}mt+="<\/script>";_d.write(mt)}
//Please leave the above line intact. The above also needs to be enabled if it not already enabled unless this file is part of a multi pack.



////////////////////////////////////
// Editable properties START here //
////////////////////////////////////

if(navigator.appVersion.indexOf("MSIE 6.0")>0)
	{
		effect = "Fade(duration=0.2);Alpha(style=0,opacity=88);Shadow(color='#777777', Direction=135, Strength=5)"
	}
else
	{
		effect = "Shadow(color='#777777', Direction=135, Strength=5)"
	}

timegap=500					// The time delay for menus to remain visible
followspeed=5				// Follow Scrolling speed
followrate=40				// Follow Scrolling Rate
suboffset_top=10;			// Sub menu offset Top position 
suboffset_left=10;			// Sub menu offset Left position
Frames_Top_Offset=0 		// Frames Page Adjustment for Top Offset
Frames_Left_Offset=-36		// Frames Page Adjustment for Left Offset



plain_style=[				// Menu Properties Array
//"navy",						// Off Font Color
//"ccccff",					// Off Back Color
//"FFEBCD",					// On Font Color
//"4B0082",					// On Back Color
//"000000",					// Border Color

"white",						// Off Font Color
"2b4973",					// Off Back Color
"000000",					// On Font Color
"BCBCBC",					// On Back Color
"000000",					// Border Color



12,							// Font Size
"normal",					// Font Style
"bold",						// Font Weight
"Verdana, Tahoma, Arial, Helvetica",	// Font
4,							// Padding
"arrow.gif"					// Sub Menu Image
,							// 3D Border & Separator
,"66ccff"					// 3D High Color
,"000099"					// 3D Low Color
]

addmenu(menu=["radiologist",
,,100,1,"",plain_style,,"left",effect,,,,,,,,,,,,
,"Worklist","dictate-worklist.php",,,
,"Addendum","addendum.php",,,
,"Re-Assign","re-assign.php",,,
,"Template","show-menu=template",,,
,"My Workload","workload-my.php",,,
,"Case Study","teaching.php",,,
,"Digital Signature","ajax_image_upload/index.php",,,
])

addmenu(menu=["template",
,,100,1,"",plain_style,,"left",effect,,,,,,,,,,,,
,"New","template-create.php",,,0
,"Edit/Delete","template-edit.php",,,0
])

addmenu(menu=["databases",
,,100,1,"",plain_style,,"left",effect,,,,,,,,,,,,
,"Film Print","printfilm.php",,,0
,"Filme Use","filmuse.php",,,0
,"Repeat Xray","report-repeat-xray.php",,,0
,"Mammo Stat","mammo.php",,,0
,"Report","reported.php",,,0
,"Work Load","show-menu=workload",,,0
,"Query","query.php",,,0
])

addmenu(menu=["mammo",
	,,120,1,"",plain_style,,"left",effect,,,,,,,,,,,,
	,"BIRAD Report","history.php?tp=win95",,,1
	,"MAMMO Tracking","history.php?tp=win98",,,1
	])

addmenu(menu=["workload",
	,,120,1,"",plain_style,,"left",effect,,,,,,,,,,,,
	,"Radiologist","workload-radiologist.php",,,1
	,"Technologist","workload-radiographer.php",,,1
	,"TurnArround","report-turn.php",,,1
	])

addmenu(menu=["oses",
,,100,1,"",plain_style,,"left",effect,,,,,,,,,,,,
,"Administrator","admin.php",,,
])

	
addmenu(menu=["help",,,120,1,,plain_style,0,"left",effect,0,,,,,,,,,,,
,"Change Password","password.php",,,1
,"Manual","manual.php",,,1
,"Report Bug","form/error-report.php",,,1
,"Administrator","admin.php",,,1
,"About ThaiRIS","aboutme.html",,,1
,"Log off","logoff.php target=_top",,,1
])


dumpmenus()

