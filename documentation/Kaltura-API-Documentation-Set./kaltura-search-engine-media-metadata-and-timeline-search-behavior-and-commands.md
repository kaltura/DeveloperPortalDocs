---
layout: page
title: Kaltura Search Engine for Media, Metadata and Timeline: Search Behavior and Commands
---

The following topics are described:

*   [Search Behavior in the Kaltura Management Console][1]
*   [Search Behavior in Kaltura MediaSpace][2]
*   [Search Behavior for the Kaltura API][3]

 [1]: #kmc
 [2]: #kms
 [3]: #search_api

<p class="mce-heading-2">
  <a name="kmc"></a>Search Behavior in the KMC
</p>

1.  The Kaltura search engine will match the search term within the KMC search box against the following <a name="entry_attributes" style="background-color: #ffffff;"></a>entry attributes:  
    *   Entry Name 
    *   Entry ID
    *   Entry Tags
    *   Entry Description
    *   Entry Reference ID
    *   Entry owner ID
    *   Entry ID of origin entry for clips created in Kaltura
    *   any Entry custom data fields of type: text that was set to be searchable
2.  Search criteria may include alphanumeric as well as special characters such as: **`, ~, @, #, $, %, ^, &, (, ), -, _, =, +, [, ], {, }, ;, :, ', \, |, /, ?, <, >. **
3.  The **spacebar** is treated as an AND search operand.   
    For example, searching for” hello world” will result with all entries that include both the word hello and the word **world** in one of the searchable entry attributes.
4.  The** **comma** (,) **character is treated as an OR search operand.   
    For example, searching for **hello, world** will result with all entries that include either the word **hello**, or the word **world** in one of the searchable entry attributes.
5.  <a name="Exclamation"></a>The exclamation** (!)** character is treated as an AND NOT search operand.   
    For example, searching for **hello ! world** should result with all entries that include the word hello but do not include the word world.   
    **NOTE:** The **!** at the beginning of the search criteria is not supported within this AND NOT operand context.  To search for words that start/end with, or contain the **!** character, you have to enter \! (backslash then exclamation mark) in the search field.    
    For example, if you want to search for entries that include the word** !hello** or **hello!**, enter the following terms within the KMC search box: **\!hello or hello\!**
6.  The exact match search is not available as a search operand. The**  **quote** ("") **characters are NOT treated as an EXACT MATCH search operand.   
    For example, searching for "**hello world" **will not yield any results.

*   Partial search – Kaltura does not support a partial word search. For example, searching for the the word ‘helloworld’ is resulted in a searc,h but searching for ‘hello’ or ‘world’ will not produce the desired reuslt.
*   Kaltura supports a partial wildcard search. You can append a search word with 3 or more characters with an asterisk * at the end of the word. For example, searching for the string hello* should result in all words beginning with hello, including helloworld.  <span style="color: #000000;">The asterisk only works as a wildcard at the end of a term. It cannot be used as a wildcard at the beginning or in the middle of a term.</span>

<span style="color: #ff0000;"><span><span class="mce-note-graphic" style="color: #000000;">It is possible to escape the * a and ! characters and treat them as literals using a backslash.</span> </span></span>

<p class="mce-heading-2">
  <a name="kms"></a>Search Behavior in Kaltura MediaSpace
</p>

<p class="mce-heading-3">
  Search in Categories, Channels and My Media:
</p>

All the [KMC rules][1] apply to the KMS Global search box except for the following changes:

1.  The character '**+**' is treated as the spacebar - and is used as the AND search operand.
2.  The exact match search is not available as a search operand. - The**  **quote** ("") **characters are NOT treated as an EXACT MATCH search operand.   
    For example, searching for "**hello world" **will not yield any results.
3.  The character "/" is not searchable and ignored by the system. For example, searching for the date 1/1/2015  searches for the string 112015.

<p class="mce-heading-3">
  In-Video Search
</p>

*   The** **comma** (,) **character for the OR operator is supported.  
    For example, searching for helllo,world will surface results with either hello or world.

*   The exclamation** (!)** character is not supported.

<p class="mce-heading-2">
  <a name="search_api"></a>Search Behavior for the Kaltura API
</p>

<p class="mce-heading-2 mce-heading-3">
  Operators
</p>

The following special operators can be used in a free text search field in the Kaltura API:

*   Exclamation mark (!) - AND NOT . Note that AND NOT is not a unary NOT operator. A positive search word must appear before the AND phrase. See [here][4] for additional information.
*   Double Quotes ("") - are treated as an EXACT MATCH search operand.
*   Backslash (\) - escape. To search for the character ! you have to enter \! in the search field.
*   Comma (,) - OR
*   Spacebar - AND

 [4]: #Exclamation

<p class="mce-heading-3">
  Blend Chars
</p>

Blended characters are indexed both as separators and valid characters. For instance, assume that & is configured as blended and AT&T occurs in an indexed document. Three different keywords will get indexed, namely "at&t", treating blended characters as valid, plus "at" and "t", treating them as separators.

The following blend chars are configured for the API search.

!, $, ', (, ), *, -, /, :, ;, <, =, #, [, \, ], ^, `, {, |, }, ~, %, &, +, >, ?, @, _

These blend characters may be used as delimiters or as characters.

 

 

 

 

 

<span style="font-size: small;"> </span>
