/************************************************
 * #### jQuery img2blob.js ####
 * Coded by Ican Bachors 2017.
 * http://ibacor.com/labs/jquery-image-to-blob/
 * Updates will be posted to this site.
 ***********************************************/
$.fn.img2blob = function(img1,img2,img3,img4) {
    var imgdefault = {
        watermark: '',
		fontStyle: 'Arial',
		fontSize: '30',
		fontColor: 'black',
		fontX: 10,
		fontY: 50
    };
	if (typeof img1 === 'object') {
		img1.watermark = (img1.watermark == undefined ? imgdefault.watermark : img1.watermark);
		img1.fontStyle = (img1.fontStyle == undefined ? imgdefault.fontStyle : img1.fontStyle);
		img1.fontSize  = (img1.fontSize  == undefined ? imgdefault.fontSize  : img1.fontSize);
		img1.fontColor = (img1.fontColor == undefined ? imgdefault.fontColor : img1.fontColor);
		img1.fontX 	= (img1.fontX     == undefined ? imgdefault.fontX     : img1.fontX);
		img1.fontY     = (img1.fontY     == undefined ? imgdefault.fontY     : img1.fontY);
	}
	if (typeof img2 === 'object') {
		img2.watermark = (img2.watermark == undefined ? imgdefault.watermark : img2.watermark);
		img2.fontStyle = (img2.fontStyle == undefined ? imgdefault.fontStyle : img2.fontStyle);
		img2.fontSize  = (img2.fontSize  == undefined ? imgdefault.fontSize  : img2.fontSize);
		img2.fontColor = (img2.fontColor == undefined ? imgdefault.fontColor : img2.fontColor);
		img2.fontX 	= (img2.fontX     == undefined ? imgdefault.fontX     : img2.fontX);
		img2.fontY     = (img2.fontY     == undefined ? imgdefault.fontY     : img2.fontY);
	}
	if (typeof img3 === 'object') {
		img3.watermark = (img3.watermark == undefined ? imgdefault.watermark : img3.watermark);
		img3.fontStyle = (img3.fontStyle == undefined ? imgdefault.fontStyle : img3.fontStyle);
		img3.fontSize  = (img3.fontSize  == undefined ? imgdefault.fontSize  : img3.fontSize);
		img3.fontColor = (img3.fontColor == undefined ? imgdefault.fontColor : img3.fontColor);
		img3.fontX 	= (img3.fontX     == undefined ? imgdefault.fontX     : img3.fontX);
		img3.fontY     = (img3.fontY     == undefined ? imgdefault.fontY     : img3.fontY);
	}
	if (typeof img4 === 'object') {
		img4.watermark = (img4.watermark == undefined ? imgdefault.watermark : img4.watermark);
		img4.fontStyle = (img4.fontStyle == undefined ? imgdefault.fontStyle : img4.fontStyle);
		img4.fontSize  = (img4.fontSize  == undefined ? imgdefault.fontSize  : img4.fontSize);
		img4.fontColor = (img4.fontColor == undefined ? imgdefault.fontColor : img4.fontColor);
		img4.fontX 	= (img4.fontX     == undefined ? imgdefault.fontX     : img4.fontX);
		img4.fontY     = (img4.fontY     == undefined ? imgdefault.fontY     : img4.fontY);
	} 
	else {
		img1 = imgdefault;
		img2 = imgdefault;
		img3 = imgdefault;
		img4 = imgdefault;
	}
	
    $(this).each(function(i, c) {
        var d = $(this).data('img2blob'),
            e = '.' + $(this).attr('class'),
			f = new Image();
		f.onload = function() {
            var g    = document.createElement('canvas');
            g.width  = f.naturalWidth;
            g.height = f.naturalHeight;
			var h    = g.getContext('2d');
            h.drawImage(f, 0, 0);
			if(img2.watermark != ''){
				h.font 		= img2.fontSize + 'px ' + img2.fontStyle;
				h.fillStyle = img2.fontColor; 
				h.fillText(img2.watermark, img2.fontX, img2.fontY);
			}
			if(img3.watermark != ''){
				h.font 		= img3.fontSize + 'px ' + img3.fontStyle;
				h.fillStyle = img3.fontColor;
				h.fillText(img3.watermark, img3.fontX, img3.fontY);
			}
			if(img4.watermark != ''){
				h.font 		= img4.fontSize + 'px ' + img4.fontStyle;
				h.fillStyle = img4.fontColor;
				h.fillText(img4.watermark, img4.fontX, img4.fontY);
			}
			if(img1.watermark != ''){
				h.font 		= img1.fontSize + 'px ' + img1.fontStyle;
				h.fillStyle = img1.fontColor;
				h.textAlign = "center"; 
				h.fillText(img1.watermark, img1.fontX , img1.fontY);
			}			
            var j = g.toDataURL('image/png'),
                k = DataUriToBinary(j),
                l = new Blob([k], {
                    type: 'image/png'
                }),
                m = window.URL.createObjectURL(l);
            $(e).eq(i).attr('src', m);
        };
        f.src = d;
    });

    function DataUriToBinary(n) {
        var o = ';base64,',
			p = n.indexOf(o) + o.length,
			q = n.substring(p),
			r = window.atob(q),
			s = r.length,
			t = new Uint8Array(new ArrayBuffer(s));
        for (i = 0; i < s; i++) {
            t[i] = r.charCodeAt(i);
        }
        return t;
    }
}
