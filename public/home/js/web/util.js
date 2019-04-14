var util = null;
function Util() {};
Util.prototype = {
	ajax : function(url, type, params, callback) {
		$.ajax({
			type : type,
			url : url,
			data : params,
			success : function(data) {
				if (data && data.status == "SUCCESS") {
					if (callback != null) {
						callback(data);
					}
				} else if (data && data.status == "FAIL") {
				}
			}
		});
	},
	getTime : function(time,format){
		var date = new Date(time);
		var datetime = date.getFullYear() + (format == 0 ? '年' : '-');
		datetime += (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + (format == 0 ? '月' : '-');
		datetime += (date.getDate() < 10 ? '0' + date.getDate() : date.getDate())+ (format == 0 ? '日' : '');
		return datetime;
	}
};
$(function() {
	util = new Util();
});