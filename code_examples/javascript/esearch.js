// 1 Params and Operator 
let searchParams = new kaltura.objects.ESearchEntryParams();
searchParams.searchOperator = new kaltura.objects.ESearchEntryOperator();
searchParams.searchOperator.searchItems = [];

// 2 Search Type 
searchParams.searchOperator.searchItems[0] = new kaltura.objects.ESearchUnifiedItem();

// 3 Search Term
searchParams.searchOperator.searchItems[0].searchTerm = "kaltura logo";

// 4 Search Item Type 
searchParams.searchOperator.searchItems[0].itemType = kaltura.enums.ESearchItemType.EXACT_MATCH;

// 5 Add Highlight
searchParams.searchOperator.searchItems[0].addHighlight = true;

// 6 Search 
kaltura.services.eSearch.searchEntry(searchParams)
.execute(client)
.then(result => {
    console.log(result);
});