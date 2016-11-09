//The following line is critical for menu operation, and MUST APPEAR ONLY ONCE. If you have more than one menu_array.js file rem out this line in subsequent files
menunum=0;menus=new Array();_d=document;
function addmenu(){menunum++;menus[menunum]=menu;}
function dumpmenus(){mt="<script language=javascript>";
for(a=1;a<menus.length;a++){mt+=" menu"+a+"=menus["+a+"];"}mt+="<\/script>";_d.write(mt)}
//Please leave the above line intact. The above also needs to be enabled if it not already enabled unless this file is part of a multi pack.


if(navigator.appVersion.indexOf("MSIE 6.0")>0){
	effect = "Fade(duration=0.2);Alpha(style=0,opacity=88);Shadow(color='#777777', Direction=135, Strength=5)"
}
else{
	effect = "Shadow(color='#777777', Direction=135, Strength=5)"
}


timegap=100					// The time delay for menus to remain visible
followspeed=5				// Follow Scrolling speed
followrate=40				// Follow Scrolling Rate
suboffset_top=10;			// Sub menu offset Top position 
suboffset_left=10;			// Sub menu offset Left position
Frames_Top_Offset=0 		// Frames Page Adjustment for Top Offset
Frames_Left_Offset=100		// Frames Page Adjustment for Left Offset



plain_style=[				// Menu Properties Array

"white",						// Off Font Color
"2b4973",					// Off Back Color
"FFEBCD",					// On Font Color
"000000",					// On Back Color
"08298A",					// Border Color

12,							// Font Size
"normal",					// Font Style
"bold",						// Font Weight
"Verdana, Tahoma, Arial, Helvetica",	// Font
3,							// Padding
"arrow.gif",				// Sub Menu Image (Leave this blank if not needed)
,							// 3D Border & Separator bar
"66ffff",					// 3D High Color
"000099",					// 3D Low Color
,							// Current Page Item Font Color (leave this blank to disable)
,							// Current Page Item Background Color (leave this blank to disable)
"arrowdn.gif",				// Top Bar image (Leave this blank to disable)
]


addmenu(menu=[		// This is the array that contains your menu properties and details
"simplemenu1",		// Menu items Name
57,					// Top
0,				// left
95,					// Width
1,					// Border Width
,					// Screen Position - here you can use "center;left;right;middle;top;bottom"
plain_style,		// Properties Array - this is set higher up, as above
1,					// Always Visible - allows the menu item to be visible at all time
"center",				// Alignment - sets the menu elements alignment, HTML values are valid here for example: left, right or center
effect,				// Filter - Text variable for setting transitional effects on menu activation
,					// Follow Scrolling - Tells the menu item to follow the user down the screen
1, 					// Horizontal Menu - Tells the menu to be horizontal instead of top to bottom style
,					// Keep Alive - Keeps the menu visible until the user moves over another menu or clicks elsewhere on the page (1=on/0=off)
,					// Position of TOP sub image left:center:right
,					// Set the Overall Width of Horizontal Menu to 100% and height to the specified amount (Leave blank to disable)
,					// Right To Left - Used in Hebrew for example. (1=on/0=off)
,					// Open the Menus OnClick - leave blank for OnMouseover (1=on/0=off)
,					// ID of the div you want to hide on MouseOver (useful for hiding form elements)
,					// Background image for menu when BGColor set to transparent.
,					// Scrollable Menu
,					// Reserved for future use
,"หน้าหลัก","main.php target=main;sourceframe=main;",,,2 // "Description Text", "URL", "Alternate URL", "Status", "Separator Bar"
,"ลงทะเบียน","register.php target=main;sourceframe=main;",,,2 
,"รายการคำสั่ง","order.php target=main;sourceframe=main;",,,2 
,"ห้องตรวจ","examroom.php target=main;sourceframe=main;",,,2 
,"รังสีแพทย์","show-menu=radiologist target=main;sourceframe=main;",,,2 
,"ค้นหา","search-all.php target=main;sourceframe=main;",,,2 
,"รายงาน","show-menu=databases target=main;sourceframe=main;",,"#",2
,"จัดการ","show-menu=oses target=main;sourceframe=main;",,"#",2
,"ช่วยเหลือ","show-menu=help target=main;sourceframe=main;",,"#",2
//,"ออกจากระบบ","logoff.php;",,"#",1
])


dumpmenus()