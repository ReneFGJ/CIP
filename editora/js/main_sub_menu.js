$('#menu0').click(function() {
	
	var vb=$("#menu0_sub").css('display');
	if (vb=="none")
	 {
	 	$('#menu0').addClass("nav_main_menu_sub_click");
	 } else {
	 	$('#menu0').removeClass("nav_main_menu_sub_click");
	 };

	$("#menu0_sub").animate({
		
		height:'toggle',
		
		},300);
	
});
$('#menu0_af').click(function(){
		var stf=$(".menu0_af_class").css('display')

		if (stf=="block")
		{
			$('#menu0_af').removeClass("menu1_af_class");
			$('#menu0_af').addClass("menu_abre");
		} else {
			$('#menu0_af').addClass("menu1_af_class");
			$('#menu0_af').removeClass("menu_abre");	
		};
});

$('#menu1').click(function() {
	
	var vb=$("#menu1_sub").css('display');
	if (vb=="none")
	 {
	 	$('#menu1').addClass("nav_main_menu_sub_click");
	 } else {
	 	$('#menu1').removeClass("nav_main_menu_sub_click");
	 };

	$("#menu1_sub").animate({
		
		height:'toggle',
		
		},300);
	
});
$('#menu1_af').click(function(){
		var stf=$(".menu1_af_class").css('display')

		if (stf=="block")
		{
			$('#menu1_af').removeClass("menu1_af_class");
			$('#menu1_af').addClass("menu_abre");
		} else {
			$('#menu1_af').addClass("menu1_af_class");
			$('#menu1_af').removeClass("menu_abre");	
		};
});


$('#menu2').click(function() {

		var vb=$("#menu2_sub").css('display');
	if (vb=="none")
	 {
	 	$('#menu2').addClass("nav_main_menu_sub_click");
	 } else {
	 	$('#menu2').removeClass("nav_main_menu_sub_click");
	 };

	$("#menu2_sub").animate({
		
		height:'toggle',
		
		},300);

});

$('#menu2_af').click(function(){
		var stf=$(".menu2_af_class").css('display')

		if (stf=="block")
		{
			$('#menu2_af').removeClass("menu2_af_class");
			$('#menu2_af').addClass("menu_abre");
		} else {
			$('#menu2_af').addClass("menu2_af_class");
			$('#menu2_af').removeClass("menu_abre");	
		};
});


$('#menu3').click(function() {

		var vb=$("#menu3_sub").css('display');
	if (vb=="none")
	 {
	 	$('#menu3').addClass("nav_main_menu_sub_click");
	 } else {
	 	$('#menu3').removeClass("nav_main_menu_sub_click");
	 };

	$("#menu3_sub").animate({
		
		height:'toggle',
		
		},300);

});
$('#menu3_af').click(function(){
		var stf=$(".menu3_af_class").css('display')

		if (stf=="block")
		{
			$('#menu3_af').removeClass("menu3_af_class");
			$('#menu3_af').addClass("menu_abre");
		} else {
			$('#menu3_af').addClass("menu3_af_class");
			$('#menu3_af').removeClass("menu_abre");	
		};
});

$('#menu4').click(function() {

		var vb=$("#menu4_sub").css('display');
	if (vb=="none")
	 {
	 	$('#menu4').addClass("nav_main_menu_sub_click");
	 } else {
	 	$('#menu4').removeClass("nav_main_menu_sub_click");
	 };

	$("#menu4_sub").animate({
		
		height:'toggle',
		
		},300);

});
$('#menu4_af').click(function(){
		var stf=$(".menu4_af_class").css('display')

		if (stf=="block")
		{
			$('#menu4_af').removeClass("menu4_af_class");
			$('#menu4_af').addClass("menu_abre");
		} else {
			$('#menu4_af').addClass("menu4_af_class");
			$('#menu4_af').removeClass("menu_abre");	
		};
});

$('#menuA').click(function() {

		var vb=$("#menuA_sub").css('display');
	if (vb=="none")
	 {
	 	$('#menuA').addClass("nav_main_menu_sub_click");
	 } else {
	 	$('#menuA').removeClass("nav_main_menu_sub_click");
	 };

	$("#menuA_sub").animate({
		
		height:'toggle',
		
		},300);

});

$('#menuA_af').click(function(){
		var stf=$(".menuA_af_class").css('display')

		if (stf=="block")
		{
			$('#menuA_af').removeClass("menu2_af_class");
			$('#menuA_af').addClass("menu_abre");
		} else {
			$('#menuA_af').addClass("menu2_af_class");
			$('#menuA_af').removeClass("menu_abre");	
		};
});