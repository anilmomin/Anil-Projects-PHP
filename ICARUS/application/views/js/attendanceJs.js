function trim(str)
{
    return str.replace(/^\s+|\s+$/g, '') ;
}

function moveSelected(listOneId, listTwoId)
{
	var listOne = document.getElementById(listOneId);
	var listTwo = document.getElementById(listTwoId);
	var toBeRemoved = new Array();
	var arrCount = 0;

	for (i = 0; i < listOne.options.length; i++)
	{
		if (listOne.options[i].selected)
		{
			listTwo.add(new Option(listOne.options[i].text, listOne.options[i].value), null);
			toBeRemoved[arrCount++] = i;
		}
	}

	for (i = 0; i < arrCount; i++)
	{
		listOne.remove(toBeRemoved[i] - i);
	}
}

function selectAllItemsOfList(listIds)
{
	var lists = listIds.split(",");
	for (i = 0; i < lists.length; i++)
	{
		var currList = lists[i];
		var sList = document.getElementById(currList);
		
		for (j = 0; j < sList.options.length; j++)
		{
			sList.options[j].selected = true;
		}
	}
}

function mark(textToMarkId, listToAddId, listsToSearch)
{
	var lists = listsToSearch.split(",");
	var txtToSearch = document.getElementById(textToMarkId);
	var txtToAdd = "", valueToAdd = "";

	for (i = 0; i < lists.length; i++)
	{
		var currList = lists[i];
		var sList = document.getElementById(currList);
		
		for (j = 0; j < sList.options.length; j++)
		{
			if (sList.options[j].text == trim(txtToSearch.value))
			{
				txtToAdd = sList.options[j].text;
				valueToAdd = sList.options[j].value;
				sList.remove(j);
			}
		}
	}

	if (valueToAdd != null && valueToAdd != null && trim(txtToSearch.value) != "")
	{
		var listAdd = document.getElementById(listToAddId);
		listAdd.add(new Option(txtToAdd, valueToAdd), null);
	}
}