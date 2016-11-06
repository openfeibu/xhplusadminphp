

$(function(){

    var oIndex = parseInt( (Math.random() * 2) + 3 ) * 12;  //几圈
    var MathRandom = parseInt((Math.random() * 12) + 1); // 随机指定位置
    var oIndex_num = MathRandom + oIndex; //  // 指定位置
    var i = 0;  //指定位置
    var j = 0;  // 总和
    var time;   //定时器
    var speed = 60; // 速度
    var cj_block = $('ul.cj_block'); // 变换li的父层
    var cj_btn_font;    //文字
    var cj_btn_wrap = $('.cj_btn-wrap'); //弹框层
    var Count = 0; //次数
    var set_speed = 500;

//    oIndex_num = oIndex + oIndex_num;


    $('.cj_btn_a .cj_btn_start').click(function(){

        Count++;
        if( Count > 3){

            $('section.cj_Count').show();   //超过三次

        }else{

            cj_btn_font = parseInt( cj_block.find('#' + (oIndex_num - oIndex)).find('span').html() );  //获取积分值


            cj_btn_wrap.hide();

            time = setInterval(skip,speed); //开始定时器

        }

    });

    $('.cj_btn_grudge').click(function(){

        cj_btn_wrap.hide();

    });
    function skip(){

        i++;
        j++;
        if( i > 12){

            i = 1;

        }

        $('section.cj').removeClass('cj_bg');

        if( j >= oIndex_num){

            cj_block.find('#' + i).addClass('active').siblings().removeClass('active');

            MathRandom = parseInt((Math.random() * 12) + 1);
            oIndex_num = parseInt( MathRandom + oIndex);

            if( cj_block.find('#' + i).hasClass("grade") ){

                i = 0;
                j = 0;

                setTimeout(function(){
                    $('.cj_grade').show();

                    $('.cj_grade .cj_btn_font').find('span').html( cj_btn_font );

                },set_speed);

                clearInterval(time);

            }else if(cj_block.find('#' + i).hasClass("thanks")){

                i = 0;
                j = 0;
                setTimeout(function(){
                    $('.cj_thanks').show();
                },set_speed);

                clearInterval(time);

            }else if(cj_block.find('#' + i).hasClass("prize")){

                i = 0;
                j = 0;
                setTimeout(function(){
                    $('section.cj').addClass('cj_bg');
                },set_speed);

                clearInterval(time);

            }else{

                clearInterval(time);

            }

        }else{

            cj_block.find('#' + i).addClass('active').siblings().removeClass('active');

        }

    }
//    function delay(){
//        alert(j);
//        j++;
//
//        if( j >= oIndex_num){
//            alert( time );
//            clearInterval(time);
//
//        }else{
//            $('ul.cj_block').find('#' + i).addClass('active').siblings().removeClass('active');
//
//            document.title = j + '| j |' + '| oIndex_num |' + oIndex_num;
//        }
//        document.title = time;
//
//    }


    /*time = setInterval(function(){

        i++;
        j++;
        if( i > 12){

            i = 1;

        }

        if( j > oIndex_num){

            clearInterval(time);

        }else{

            $('ul.cj_block').find('#' + i).addClass('active').siblings().removeClass('active');

        }

    },60);*/



	//签到
    $('.sign_close').click(function(){

        $('.sign_window').hide();

    });
    $('.sign_header_btn').click(function(){

        $('.sign_window').show();

    });

	var sign_rLeft = 68;    //初始值
    var sign_rLeft2 = 78;   //走多少
    var sign_r = $('div.sign_r'); //机器人
    var hint = $('div.sign_content_hint');	//再签到1天，有惊喜！
    var line= $('div.sign_content_line');	//条线 1 - 30
    var lineBackground = parseInt(line.css( 'background-position' ));	//条线 1 - 30


    //alert(sign_r.offset().left);

    hint.css({ left : sign_r.offset().left + 30 , top : sign_r.offset().top - 50}); // 获取 再签到1天，有惊喜！的left 与 top

    var line2 = $('div.sign_content_line2'); // 条线2 没文字
    var line2Background = parseInt(line2.css( 'background-position'));	 // 条线2 没文字

    var sign_content_block = $('.sign_content_block');	// 天数
    var sign_content_blockHtml = sign_content_block.html(); //天数

    $('.sign_footer_btn').click(function(){

        sign_content_blockHtml++;	// 天数自加

        if( sign_content_blockHtml > 30){ // 天数大于30
        	sign_content_blockHtml = 31;
        }else{
        	sign_content_block.html( sign_content_blockHtml ); // 天数等下本来自加
        }
        if( sign_content_blockHtml < 8 ){ // 天数小于8

	        sign_rLeft = sign_rLeft + sign_rLeft2; //人物的移动值

	        sign_r.css({ 
		        left: sign_rLeft
	        });// 机器人

	        line2Background = line2Background + sign_rLeft2;	// 条线2 没文字

	        line2.css( 'background-position' , line2Background);	// 条线2 没文字

	        hint.css({ left : sign_r.offset().left + 108 , top : sign_r.offset().top - 50});	//再签到1天，有惊喜！
	        if( hint.offset().left + hint.width() > $('body').width() ){
	        	hint.css( {
	        		'transform' : 'translateX(-110%)',
	        		'-webkit-transform' : 'translateX(-110%)',
	        		'-moz-transform' : 'translateX(-110%)',
	        		'-ms-transform' : 'translateX(-110%)',
	        		'-o-transform' : 'translateX(-110%)'
	        	});
	        }

        }else if( sign_content_blockHtml > 30){

        	return false;

        }else{

	        lineBackground = lineBackground + sign_rLeft2;

        	$('.sign_content_line').css( 'background-position' , -lineBackground);

        	return false;

        }

    	

    });
//jttest.npower2010-oa.com

    /*var sign_rLeft = 68;    //初始值
    var sign_rLeft2 = 78;   //走多少
    var sign_rLeft3;    //总和
    var sign_rLeft4;    //给background 赋值
    var sign_index = 0;
    var sign_index2 = -1;    //给background 的索引
    var sign_content_block = $('.sign_content_block');
    var sign_content_blockHtml = sign_content_block.html();
    var sign_content_line = $('.sign_content_line');

    var a = 0;


    //签到
    $('.sign_close').click(function(){

        $('.sign_window').hide();

    });

    var line2 = $('div.sign_content_line2');
    var line2Background = parseInt(line2.css( 'background-position'));
    var line2_index = 0;
    var line_rLeft;

    $('.sign_footer_btn').click(function(){

        sign_index++;   //人物的移动索引
        sign_index2++;  // 第一条线的移动索引
        line2_index++;  //第二条线的移动索引

        sign_rLeft3 = sign_rLeft + (sign_rLeft2 * sign_index); //人物的移动值
        sign_rLeft4 = sign_rLeft + (sign_rLeft2 * sign_index2);// 第一条线的移动值


        sign_content_blockHtml++;
        sign_content_block.html( sign_content_blockHtml );

        if( sign_index % 3 == 0 ){

//            if( parseInt( sign_content_line.css( 'background-position')) < - 1750 ){
//
//                    $('div.sign_r').css({ 'transform' : 'translateX( '+sign_rLeft3+'px)'});
//
//            }else{
//                $('.sign_content_line').css( 'background-position' , -sign_rLeft4-10);
//
//                $('div.sign_r').css({ 'transform' : 'translateX( 68px)'});
//                sign_index = 0;
//
//            }
                $('div.sign_r').css({ 'transform' : 'translateX( 68px)'});

                $('.sign_content_line').css( 'background-position' , -sign_rLeft4-10);


                line2Background = line2Background - (sign_rLeft2 * 2);

                $('div.sign_content_line2').css( 'background-position' , line2Background);
                sign_index = 0;



        }
        else{

            if( sign_content_blockHtml >= 30){

                return false;

            }else{

                $('div.sign_r').css({ 'transform' : 'translateX( '+sign_rLeft3+'px)'});

                line2Background = line2Background + sign_rLeft2;

                $('div.sign_content_line2').css( 'background-position' , line2Background);
            }

        }

    });*/


});














