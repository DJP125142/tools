//给需要预览的img标签加上一个zoomImg的类即可

$(function(){
    $(".zoomImg").on("click",function(){
        var newImgHtml = '<div class="mb" style="position: fixed;left: 0;top: 0;width: 100%;height: 100%;background: #000;opacity: 0.5;display: none;z-index: 999;"></div><div class="zoom" id="zoom" style="position: fixed;left: 50%;top: 50%;width: 700px;height:700px;margin-left: -350px;margin-top: -350px;display: none;z-index: 9999;"><div class="close" style="opacity: 1;filter: alpha(opacity=100);position: fixed;right: 50px;top: 50px;display: block;width: 48px;height: 48px;background: url(http://admin.aibiaozhu.top/Public/Admin/images/close.png) 0 0 no-repeat;background-size: 100% 100%;z-index: 1002;"></div></div>';
        $("body").append(newImgHtml);
        var imgSrc = $(this).attr('src');
        $(".zoom").append('<div class="zoomDiv" id="zoomDiv" style="position: fixed;left: 50%;top: 50%;width: 700px;height:700px;margin-left: -350px;margin-top: -350px;z-index: 10000;"><img class="zoomFly" id="zoomFly" src="'+imgSrc+'" style="position: absolute;left: 0;top: 0;width:100%;height: 100%"/></div>')

        // 创建对象
        var img = new Image();
        // 改变图片的src
        img.src = imgSrc;
        // 加载完成执行
        img.onload = function(){
            var imgHeight = img.height;
            var imgWidth = img.width;
            $(".zoom,.zoomDiv").css({
                left: '50%',
                top: '50%',
                height: imgHeight,
                width: imgWidth,
                'margin-left': - imgWidth / 2,
                'margin-top': - imgHeight / 2
            });

            $(".mb").fadeIn();
            $(".zoom").fadeIn();
        };

        //关闭图片
        $(".close").on("click",function(){
            $('.mb').remove();
            $('.zoom').remove();
            $(".mb").fadeOut();
            $(".zoom").fadeOut();
        });


        //滚轮事件
        var myimage =document.getElementById("zoomDiv");
        if (myimage.addEventListener) {
            // IE9, Chrome, Safari, Opera
            myimage.addEventListener("mousewheel", MouseWheelHandler, false);
            // Firefox
            myimage.addEventListener("DOMMouseScroll", MouseWheelHandler, false);
        }
        function MouseWheelHandler(e) {
            var myimage = document.getElementById("zoomDiv");
            var zoom = parseInt(myimage.style.zoom, 10)||100;
            zoom+=event.wheelDelta/12;
            if (zoom>0) myimage.style.zoom=zoom+'%';
            return false;
        }

        //拖拽图片
        var oDiv = document.getElementById("zoomFly");
        oDiv.onmousedown=function(ev) {
            var oEvent = ev;
            var disX = oEvent.clientX - oDiv.offsetLeft;
            var disY = oEvent.clientY - oDiv.offsetTop;
            document.onmousemove=function (ev) {
                oEvent = ev;
                oDiv.style.left = oEvent.clientX -disX+"px";
                oDiv.style.top = oEvent.clientY -disY+"px";
            };
            document.onmouseup=function() {
                document.onmousemove=null;
                document.onmouseup=null;
            }

        }
    });

});