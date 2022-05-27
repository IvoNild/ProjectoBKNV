//Make a request at the dataBase without refresh the page
function makeRequest({formIdentifier,url=null,method=null,data,
	success=null,responseField=null,timeOut=0})
{
	if(success==null &&  responseField==null)
	{
		throw new Exception("success field and responseField can not be empty simultaneously");
	}
	else if(success!=null && responseField!=null)
	{
		throw new Exception("success field and responseField can not be filled simultaneously");
	}
	else if(responseField!=null)
	{
		success=function(response){
			if(timeOut>0)
			{
				$(responseField).fadeIn().html(response);
				setTimeout(function(){
					$(responseField).fadeOut().html(response);
				},timeOut);
			}
			else
			{
				$(responseField).html(response);
			}
		}
	}
	if(url==null)
		url=$(formIdentifier).attr('action');
	if(method==null)
		method=$(formIdentifier).attr('method');
	$(formIdentifier).ajaxSubmit({url:url,data:data,success:success,method:method});
}