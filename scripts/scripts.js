$(document).ready(function () {    
    $("#nav li ul").css('display','none');
    $("ul > li.closed").click(function (e) {
        if (e.target === this) {
            $(this).siblings("li.open").find(" > ul").slideToggle('fast',function(){
                $(this).parents("li.open:first").toggleClass("open closed");   
            });

            $(this).toggleClass("closed open").find(" > ul").slideToggle('fast');
        }
    });
});

function hideshow(which){
	if (!document.getElementById)
		return
	if (which.style.display=="block")
		which.style.display="none"
	else
		which.style.display="block"
}

function passToHidden(value, idToShow, idToPass) {
    $(idToPass).val(value);
    console.log($('#rating').val());
    $('.'+idToShow).css('visibility', 'visible');
}

function processRating(user_id, question_id, answer_id, rating, idToShow) {
    console.log(user_id+' '+question_id+' '+answer_id+' '+rating+' '+idToShow);
    var xmlHttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    if (xmlHttp) {
        try {
            xmlHttp.open('GET', 'process/rate_answer.php?user_id='+user_id+'&question_id='+question_id+'&answer_id='+answer_id+'&rating='+rating, true);
            xmlHttp.send();
            xmlHttp.onreadystatechange = function() {
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    var result = xmlHttp.responseText;
                    $('#'+idToShow).html(result);
                    $('#'+idToShow).removeAttr('onClick');
                }
            };
        } catch(e) {
            alert(e.toString());
        }
    }
}

function followQuestion(user_id, question_id, idToProcess) {
    var xmlHttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    if (xmlHttp) {
        try {
            xmlHttp.open('GET', 'process/follow_question.php?user_id='+user_id+'&question_id='+question_id, true);
            xmlHttp.send();
            xmlHttp.onreadystatechange = function() {
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    var result = xmlHttp.responseText;
                    console.log(result);
                    $('.question_content #'+idToProcess).html(result);
                    $('.question_content #'+idToProcess).removeAttr('onClick');
                }
            };
        } catch(e) {
            alert(e.toString());
        }
    }
}