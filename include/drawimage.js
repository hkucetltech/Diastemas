<!--<img src="photoUrl" width="100"  border="0" onload="javascript:DrawImage(this,216,335);">-->
var flag=false;
function DrawImage(ImgD,w,h){
var image=new Image();
image.src=ImgD.src;

ImgD.width=image.width;
ImgD.height=image.height;

if(image.width>w){
ImgD.width=w;
ImgD.height=(image.height*w)/image.width;
image.width=ImgD.width;
image.height=ImgD.height;
}
ImgD.style.display="";
//ImgD.alt=image.width+"x"+image.height;

if(image.height>h)
{
ImgD.height=h;
ImgD.width=(image.width*h)/image.height;
image.width=ImgD.width;
image.height=ImgD.height;
}
ImgD.style.display="";
//ImgD.alt=image.width+"x"+image.height;
}