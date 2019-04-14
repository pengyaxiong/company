var register = null;
function Register() {
}
Register.prototype = {
	params : {
		"name" : "",
		"age" : 0,
		"phone" : "",
		"mail" : "",
		"activityId" : 0,
		"activityType" : 0
	},
	type : {
		"INTEREST" : 1,
		"REGISTER" : 2
	},
	initEvent : function() {
		this.isFull();
		this.focus(this.type.INTEREST);
		this.blur(this.type.INTEREST);
		this.focus(this.type.REGISTER);
		this.blur(this.type.REGISTER);
		this.register(register.type.INTEREST);
		this.register(register.type.REGISTER);
	},
	setParams : function(type) {
		var id = "#register";
		if(type == this.type.INTEREST){
			id = "#interest";
		}
		$(id+" .apply input").each(function() {
			if($(this).val().length > 0){
				register.params[$(this).attr("name")] = $(this).val();
			}
		});
	},
	reSetParams : function(){
		register.params = {
				"name" : "",
				"age" : 0,
				"phone" : "",
				"mail" : "",
				"activityId" : 0,
				"activityType" : 0
			};
	},
	reSetForm : function(type){
		var id = "#register";
		if(type == this.type.INTEREST){
			id = "#interest";
		}
		$(id+" .apply input[type='text']").each(function() {
			if($(this).val().length > 0){
				$(this).val("");
			}
		});
	},
	checkName : function(type){
		var name = register.params.name;
		var checkFlag = true;
		if (name.length <= 0) {
			checkFlag = false;
			this.errorTips("name", "姓名不能为空", type);
		} else if (name.length >= 256) {
			checkFlag = false;
			this.errorTips("name", "姓名长度不能超过256个字符", type);
		}
		return checkFlag;
	},
	checkAge : function(type) {
		var age = register.params.age;
		var checkFlag = true;
		if (age.length > 0 && isNaN(Number(age))) {
			checkFlag = false;
			this.errorTips("age", "请输入整数年龄", type);
		}
		if (age > 100) {
			checkFlag = false;
			this.errorTips("age", "请输入合法的年龄", type);
		}
		return checkFlag;
	},
	checkParam : function(type) {
		this.removeAllTips(type);
		var cehckFlag = false;
		cehckFlag = this.checkName(type);
		if(type == this.type.INTEREST){
			return cehckFlag & this.checkPhoneOrEmail();
		}else if(type == this.type.REGISTER){
			return cehckFlag & this.checkPhone(type) & this.checkEmail(type);
		}
	},
	checkPhoneOrEmail: function(){
		var mail = register.params.mail;
		var phone = register.params.phone;
		var type = this.type.INTEREST;
		var checkFlag = true;
		if(phone.length <= 0 && mail.length <= 0){
			this.errorTips("mail", "电话和邮件地址至少填写一个", type);
			this.errorTips("phone", "电话和邮件地址至少填写一个", type);
			checkFlag = false;
		}
		if(mail.length > 0){
			checkFlag = this.checkEmail(type);
		}else if(phone.length > 0){
			checkFlag = this.checkPhone(type);
		}
		return checkFlag;
	},
	checkEmail : function(type) {
		var mail = register.params.mail;
		var checkFlag = true;
		var regFalg = true;
		var reg = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
		var regx = new RegExp(reg);
		if (!regx.test(mail)) {
			regFalg = false;
		}
		if (mail.length > 0 && !regFalg) {
			checkFlag = false;
			this.errorTips("mail", "只能填写有效电子邮件地址", type);
		}
		return checkFlag;
	},
	checkPhone : function(type) {
		var phone = register.params.phone;
		var checkFlag = true;
		var regFalg = true;
		var reg = /^[1][0-9][0-9]{9}$/;
		var regx = new RegExp(reg);
		if (!regx.test(phone)) {
			regFalg = false;
		}
		if (type == register.type.REGISTER && phone.length != 11) {
			checkFlag = false;
			this.errorTips("phone", "请输入11位手机号码", type);
		} else if (type == register.type.REGISTER && !regFalg) {
			checkFlag = false;
			this.errorTips("phone", "请输入11位合法的手机号码", type);
		} else if(type == register.type.INTEREST && phone.length > 0 && !regFalg){
			checkFlag = false;
			this.errorTips("phone", "请输入11位合法的手机号码", type);
		}
		return checkFlag;
	},
	reSetPlaceHolder : function(this_){
		$(this_).removeClass("h_highlight");
		$(this_).next("img").addClass("hide");
		$(this_).parent("div").siblings("span").addClass("hide");
	},
	removeAllTips : function(type){
		var id = "#register";
		if(type == this.type.INTEREST){
			id = "#interest";
		}
		$(id+" .apply input").removeClass("h_highlight");
		$(id+" .apply input").each(function(){
			register.reSetPlaceHolder(this);
		});
	},
	errorTips : function(name, text, type) {
		var id = "#register";
		if(type == this.type.INTEREST){
			id = "#interest";
		}
		var input = $(id+" .apply input[name='" + name + "']");
		input.addClass("h_highlight");
		input.next("img").removeClass("hide");
		input.parent("div").siblings("span").removeClass("hide");
	},
	focus : function(type) {
		var id = "#register";
		if(type == this.type.INTEREST){
			id = "#interest";
		}
		$(id+" .apply input").focus(function(){
			register.reSetPlaceHolder(this);
		});
	},
	blur : function(type){
		var id = "#register";
		if(type == this.type.INTEREST){
			id = "#interest";
		}
		$(id+" .apply input").blur(function(){
			if($(this).attr("name") == "name"){
				register.params.name = $(this).val();
				register.checkName(type);
			}else if($(this).attr("name") == "phone"){
				register.params.phone = $(this).val();
				register.checkPhone(type);

			}else if($(this).attr("name") == "mail"){
				register.params.mail = $(this).val();
				register.checkEmail(type);
			}
		});
	},
	result : function(data,type){
		if(data && data.status == "SUCCESS"){
			if(type == this.type.INTEREST){
				location.href = "http://www.sanyi.org/js/submit.html";
			}else if(type == this.type.REGISTER){
				location.href = "http://www.sanyi.org/js/success.html";
			}
		}else if(data && data.status == "FAIL"){
			if(data.code == 5002){
				location.href = "http://www.sanyi.org/js/submit.html";
			}
		}
	},
	isRegister : function(){
		if($("#register .apply input[name='isRegister']").val() != 0){
			$("#register").removeClass("hide");
			return true;
		}
		return false;
	},
	isFull : function(){
		if(register.isRegister() && $("#register").length != 0){
			var activityId = $("#register .apply input[name='activityId']").val();
			var activityType = $("#register .apply input[name='activityType']").val();
			$.ajax({
				type : "GET",
				url : "api/register/isFull.htm?activityId="+activityId+"&activityType="+activityType,
				success : function(data) {
					if(data && data.status == "FAIL"){
						if(data.code == 5002){
							$("#register a").text("加入等候名单");
							$("#register .apply input[name='activityType']").val(1);
							$("#register a").next("span").removeClass("hide");
						}
					}
				}
			});
		}
	},
	register : function(type) {
		var id = "#register";
		if(type == this.type.INTEREST){
			id = "#interest";
		}
		$(id+" .apply a").click(function() {
			register.setParams(type);
                        var type_ = register.params.activityType;
			if (register.checkParam(type)) {
				$.ajax({
					type : "POST",
					url : "http://www.sanyi.org/js/api/register/activity.htm",
					data : register.params,
					success : function(data) {
						register.reSetForm(type);
						register.result(data,type_);
					}
				});
			}
			register.reSetParams();
		});
	}
};

$(function() {
	register = new Register();
	register.initEvent();
});
