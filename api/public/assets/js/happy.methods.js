var happy = {
    USPhone: function (val) {
        return /^\(?(\d{3})\)?[\- ]?\d{3}[\- ]?\d{4}$/.test(val);
    },

    // matches mm/dd/yyyy (requires leading 0's (which may be a bit silly, what do you think?)
    date: function (val) {
        return /^(?:0[1-9]|1[0-2])\/(?:0[1-9]|[12][0-9]|3[01])\/(?:\d{4})/.test(val);
    },

    email: function (val) {
        return /^(?:\w+\.?\+?)*\w+@(?:\w+\.)+\w+$/.test(val);
    },

    minLength: function (val, length) {
        return val.length >= length;
    },

    maxLength: function (val, length) {
        return val.length <= length;
    },
	
	interLength: function (val, length , length1) {
        return val.length >= length && val.length <= length1 ;
    },
	
    equal: function (val1, val2) {
        return (val1 == val2);
    },
	
	minmaxLength: function (val, minlength,maxlength){
		return val.length >= minlength && val.length <= maxlength ? true : false ;
	},
	
	/*
	* val ： 图片的class
	* minsize : 最少多少张
	* maxsize : 最多多少张
	*/
	isPictureSize: function (val,minsize,maxsize){
		return $("."+val).size() >= minsize && $("."+val).size() <= maxsize ? true : false ;
	},
	
	isMobile :function (val){
		return /^1[3|5|8][0-9]\d{4,8}$/.test(val);
	},
	
};
