(function($)
{   
$.extend(
{
    aicc:function(p)
    {                   
        var _sid      = getUrlVar('AICC_SID');
        var _url      = getUrlVar('AICC_URL');
        var _action   = (p['action']=='set')?setAICC(p['score'],p['time'],p['credit'],p['location'],p['status']):(p['action']=='get')?getAICC():(p['action']=='exit')?exitAICC():false;           
        function getUrlVar(urlVar)
        {
            var match = RegExp('[?&]' + urlVar + '=([^&]*)').exec(window.location.search);      
            return unescape(match && decodeURIComponent(match[1].replace(/\+/g, ' '))); 
        }
		/*
		Request Parameters
			Command=PutParam
			Version=2.0
			Session_id={SESSIONID}
			Aicc_data=
			[Core]
			Lesson_Location={Location of where user left off}
			Lesson_Status={Status: Not Started, Incomplete, Completed, Passed, or Failed}
			Score={Score}
			Time={Time in Session}
			[Core_Lesson]
			{Free-formed text up to 4k}
		Response Returns
			Error={Error Number}
			Error_text={Error String}
		*/
        function setAICC(s,t,c,l,ls,c)
        {
            $.post(_url,{command:"PutParam",version:"2.2",session_id:_sid, aicc_data:"[CORE]\nlesson_location="+l+"\ncredit="+c+"\nscore="+s+"\ntime="+t+"\nlesson_status="+ls},function(r)
            { 
                p['response'].call(this,json(r));
            })
            .error(function(a,b,c){p['response'].call(this,c);});
        }
		
		/*
		Request Parameters
			Command=GetParam
			Version=2.0
			Session_id={SESSIONID}
		Response Returns
			Error={Error Number}
			Error_text={Error String}
			Aicc_data=
			[Core]
			Student_ID={Student ID}
			Student_Name={Student Name: Last Name, First Name}
			Lesson_Location={Location of where user left off}
			Lesson_Status={Status: Not Started, Incomplete, Completed, Passed or Failed}
			Score={Score}
			Time={Time in Session}
			[Core_Lesson]
			{Free-formed text up to 4k}
		*/
        function getAICC()
        {
            $.get(_url,{command:"GetParam",version:"2.2",session_id:_sid},function(r)
            {
                p['response'].call(this,json(r));
            })
            .error(function(a,b,c){p['response'].call(this,c);});
        }
		/*
		Request Parameters
			Command=ExitAU
			Version=2.0
			Session_id={SESSIONID}
		
		Response Returns
			Error={Error Number}
			Error_text={Error String}
		*/
		function exitAICC(){
			$.post(_url,{command:"ExitAU",version:"2.2",session_id:_sid},function(r){
				p['response'].call(this,json(r));
			}).error(function(a,b,c){p['response'].call(this,c);});
		}
        function json(str)
        {
		console.log(str +"\n");
            var obj = {};
            str.replace(/([^=]+)=(.*)\n/g,function(_,name,value){
				obj[name.toLowerCase()]=value;
			});    
            return obj;
        }
    }
}); 
})(jQuery);