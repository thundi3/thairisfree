/*
 Milonic DHTML Website Navigation Menu
 Written by Andy Woolley - Copyright 2002 (c) Milonic Solutions Limited. All Rights Reserved.
 Please visit http://www.milonic.com/ for more information.
 
 The Free use of this menu is only available to Non-Profit, Educational & Personal web sites.
 Commercial and Corporate licenses  are available for use on all other web sites & Intranets.
 All Copyright notices MUST remain in place at ALL times and, please keep us informed of your 
 intentions to use the menu and send us your URL.
 
 If you are having difficulty with the menu please read the FAQ at http://www.milonic.com/faq.php before contacting us.

*/

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
,"รายการรออ่าน","dictate-worklist.php",,,
,"Addendum","addendum.php",,,
,"แก้ไขผลอ่าน","editreport1.php",,,              //,"แก้ไขผลอ่าน","editreport1.php",,,
,"Re-Assign","re-assign.php",,,
,"Template","show-menu=template",,,
,"My Workload","workload-my.php",,,
,"Case Study","teaching.php",,,
,"รูปลายเซ็นต์","ajax_image_upload/index.php",,,
])

addmenu(menu=["template",
,,100,1,"",plain_style,,"left",effect,,,,,,,,,,,,
,"สร้างใหม่","template-create.php",,,0
,"แก้ไข/ลบ","template-edit.php",,,0
])

addmenu(menu=["databases",
,,100,1,"",plain_style,,"left",effect,,,,,,,,,,,,
,"การพิมพ์ฟิล์ม","printfilm.php",,,0
,"การใช้ฟิล์ม","filmuse.php",,,0
,"การเอกซเรย์ซ้ำ","report-repeat-xray.php",,,0
,"สถิติ Mammo","mammo.php",,,0
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
	,"รังสีแพทย์","workload-radiologist.php",,,1
	,"รังสีเทคนิค","workload-radiographer.php",,,1
	,"เครื่องเอกซเรย์","workload-modality.php",,,1
	,"คำสั่งตรวจ","workload-procedure.php",,,1
	,"แพทย์","workload-referrer.php",,,1
	,"แผนก","workload-department.php",,,1
	,"TurnArround","report-turn.php",,,1
	,"Order Canceled","report-cancel.php",,,1
	])

addmenu(menu=["oses",
,,100,1,"",plain_style,,"left",effect,,,,,,,,,,,,
,"ข้อมูลคนไข้","patient.php",,,
,"รวมแฟ้มคนไข้","mergepatient.php",,,
,"นัดหมาย","show-menu=scheduler",,,
,"Stock","stockshow.php",,,
,"คำสั่งตรวจเอกซเรย์","procedureshow.php",,,
,"ยืม/คืน ฟิล์ม","filmfolder.php",,,
,"ผู้ดูแลระบบ","show-menu=admin",,,
])

addmenu(menu=["report",
,,100,1,"",plain_style,,"left",effect,,,,,,,,,,,,
,"Turnaround Time","blank.php",,,0
,"รายการสั่งตรวจ","blank.php",,,0
,"รายการผู้ป่วย","blank.php",,,0
,"รายการบริการ","blank.php",,,0
,"รายการนัดผู้ป่วย","blank.php",,,0
,"รายการจำนวนคนไข้","blank.php",,,0
,"สรุปรายได้","blank.php",,,0
,"สรุปรายการตรวจจริง","blank.php",,,0
])

addmenu(menu=["admin",
	,,120,1,"",plain_style,,"left",effect,,,,,,,,,,,,
	,"แก้ไขหน้าข่าว","editnews.php",,,1
	,"Staff","staff.php",,,1
	,"Printing Queue","print-1.php",,,1
	,"Re-send HL7","hl7-resend.php",,,1
	])

addmenu(menu=["scheduler",
	,,120,1,"",plain_style,,"left",effect,,,,,,,,,,,,
	,"ตารางนัดหมาย","scheduler/php-examples/calendar.php",,,
	,"นัดหมายด่วน","scheduler/php-examples/calendar_dummy.php",,,1	
	,"Block ตารางนัด","scheduler/php-examples/calendar_except.php",,,1
	,"รายการนัด","staff.php",,,1
	,"ตารางรังสีแพทย์","staff.php",,,1
	])
	
addmenu(menu=["help",,,120,1,,plain_style,0,"left",effect,0,,,,,,,,,,,
,"เปลี่ยนรหัสผ่าน","password.php",,,1
,"คู่มือการใช้งาน","manual.php",,,1
,"User Setting","usercode.php",,,1
,"แจ้งปัญหาการใช้งาน","form/error-report.php",,,1
,"หน้าเว็บผู้ดูแลระบบ","admin.php",,,1
,"เกี่ยวกับThaiRIS","aboutme.html",,,1
,"ออกจากระบบ","logoff.php target=_top",,,1
])


dumpmenus()

//radiologist 
//Dictate
//teaching file
//Addendum
//