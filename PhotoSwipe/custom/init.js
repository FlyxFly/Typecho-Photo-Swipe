//初始化URL数组
const items=[];

// 获取PhotoSwipe元素
const pswpElement = document.querySelectorAll('.pswp')[0];

async function init(){

    // 生成URL数组
    const imgs=document.querySelectorAll('.post-content img');
    for (var i = imgs.length - 1; i >= 0; i--) {
        const size=await getImageSize(imgs[i].src);
        items.push({
            src:imgs[i].src,
            w:size.width,
            h:size.height
        })
    }
    // 绑定图片点击事件
    document.querySelector('.post-content').addEventListener('click',(e)=>{
        console.log(e.target.nodeName);
        if(e.target.nodeName==='IMG'){
            event.preventDefault();
            openGallery(e.target.src);
        }
    })

}

init();




// 打开图片浏览器
function openGallery(url){
    const options = {
        // optionName: 'option value'
        // for example:
        index: 0 // start at first slide
    };

    for (var i = items.length - 1; i >= 0; i--) {
        if(url==items[i].src){
            options.index=i;
        }
    }
    const gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
}


// 获取图片尺寸
function getImageSize(url){
    return new Promise((resolve,reject)=>{
        var img_url = url;
        // 创建对象
        var img = new Image()
        // 改变图片的src
        img.src = img_url
        // 定时执行获取宽高
        var check = function(){
         // 只要任何一方大于0
         // 表示已经服务器已经返回宽高
            if (img.width>0 || img.height>0) {
                resolve({
                    height:img.height,
                    width:img.width
                })
                clearInterval(set);
            }
        }
        var set = setInterval(check,40)
        // 加载完成获取宽高
        img.onload = function(){
            resolve({
                height:img.height,
                width:img.width
            })
        };
    })
}