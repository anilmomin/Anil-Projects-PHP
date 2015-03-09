var mainCounter = 1;
var optionsQuestion = new Array();

function addQuestion(quizDivTagId)
{
	var mainDiv = document.getElementById(quizDivTagId);
	var questionDiv = document.createElement("div");
	questionDiv.setAttribute("id", "QuestionNumber" + mainCounter);

	var questionNumber = document.createElement("big");
	questionNumber.appendChild(document.createTextNode(mainCounter + " .) "));
	
	var crossButton = document.createElement("input");
	crossButton.setAttribute("onclick", "deleteQuestion('QuestionNumber" + mainCounter + "')");
	crossButton.setAttribute("value", " X ");
	crossButton.setAttribute("name", "deleteQuestionButton");
	crossButton.setAttribute("type", "button");
	
	var questionBox = document.createElement("input");
	
	questionBox.setAttribute("type", "text");
	questionBox.setAttribute("name", "QuestionNumber" + mainCounter + "Text");
	
	var answerButton = document.createElement("input");
	
	answerButton.setAttribute("type", "button");
	answerButton.setAttribute("name", "answerButton");
	answerButton.setAttribute("onClick", "addOption('QuestionNumber" + mainCounter + "')");
	answerButton.setAttribute("value", "Add Option");
	
	questionDiv.appendChild(questionNumber);
	questionDiv.appendChild(crossButton);
	questionDiv.appendChild(questionBox);
	questionDiv.appendChild(answerButton);
	mainDiv.appendChild(questionDiv);
	mainDiv.appendChild(document.createElement("br"));
	
	optionsQuestion["QuestionNumber" + mainCounter] = 0;
	
	mainCounter++;
}

function addOption(questionDivTagId)
{
	var questionDiv = document.getElementById(questionDivTagId);

	var crossButton = document.createElement("a");

	crossButton.setAttribute("onclick", "deleteOption('" + questionDivTagId + ":" + optionsQuestion[questionDivTagId] + "');");
	crossButton.setAttribute("id", "crossButton");
	crossButton.setAttribute("title", "Delete Option");

	crossButton.appendChild(document.createTextNode("[ X ]"));

	var optionDiv = document.createElement("div");

	optionDiv.setAttribute("id", questionDivTagId + ":" + optionsQuestion[questionDivTagId]);

	var optionNumber = document.createTextNode(String.fromCharCode(parseInt(optionsQuestion[questionDivTagId] + 97)) + " .) ");
	
	var optionBox = document.createElement("input");
	
	optionBox.setAttribute("type", "text");
	optionBox.setAttribute("name", questionDivTagId + "[]");
	optionBox.setAttribute("id", "InputOf:" + questionDivTagId + ":" + optionsQuestion[questionDivTagId]);
	optionBox.setAttribute("onchange", "makeValuesEqual('InputOf:" + questionDivTagId + ":" + optionsQuestion[questionDivTagId] + "', 'CheckBoxOf:" + questionDivTagId + ":" + optionsQuestion[questionDivTagId] + "');");

	var checkBox = document.createElement("input");
	checkBox.setAttribute("type", "checkbox");
	checkBox.setAttribute("name", questionDivTagId + "CorOps[]");
	checkBox.setAttribute("value", optionsQuestion[questionDivTagId]);
	checkBox.setAttribute("id", "CheckBoxOf:" + questionDivTagId + ":" + optionsQuestion[questionDivTagId])

	var isCorrectText = document.createTextNode(" Is Correct ");
	
	optionDiv.appendChild(optionNumber);
	optionDiv.appendChild(optionBox);
	optionDiv.appendChild(checkBox);
	optionDiv.appendChild(isCorrectText);
	optionDiv.appendChild(crossButton);

	questionDiv.appendChild(optionDiv);
	
	optionsQuestion[questionDivTagId]++;
}
	
function deleteQuestion(questionDivTagId)
{
	var questionDiv = document.getElementById(questionDivTagId);
	questionDiv.innerHTML = "";
	questionDiv.outerHTML = "";
}

function deleteOption(optionDivTagId)
{
	var optionDiv = document.getElementById(optionDivTagId);
	optionDiv.innerHTML = "";
	optionDiv.outerHTML = "";
}

function makeValuesEqual(idOne, idTwo)
{
	var objOne = document.getElementById(idOne);
	var objTwo = document.getElementById(idTwo);
	
	objTwo.value = objOne.value;
}

function confirmDelete()
{
    return confirm("Are you sure you wish to delete this entry?");
}