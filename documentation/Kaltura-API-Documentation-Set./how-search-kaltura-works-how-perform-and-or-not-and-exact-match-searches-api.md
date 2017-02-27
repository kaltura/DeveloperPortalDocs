---
layout: page
title: "How the Search in Kaltura Works (How to perform AND, OR, NOT and Exact Match searches in API)."
date: 2012-10-02 15:31:01
---

<p class="mce-heading-2">
  Background
</p>

Kaltura uses the <a href="http://sphinxsearch.com/" target="_blank">Open Source Search Server Sphinx</a> to perform its metadata indexing and search. The Kaltura Search API and Custom Metadata Search API provide an abstraction layer on top of Sphinx's search capabilities.

**We recommend reading [Kaltura Search Engine for Media, Metadata and Timeline: Search Behavior and Commands][1] for more details on the topic of search operators and behavior in Kaltura.**

 [1]: http://knowledge.kaltura.com/node/247

<p class="mce-heading-2">
  OR and AND operators
</p>

For the base metadata (name, tags, description, entryId, etc.) - the system only provides an AND operator.  
To run an OR query on the base metadata, the following search filter should be used: <span style="font-family: 'courier new', courier;"><strong>filter:freeText</strong></span>.  
The freeText filter performs an OR search across the following base entry fields: name, tags, description, entry\_id, reference\_id, roots, puser_id.

When searching Custom Metadata fields, it is possible to control the search operator when setting the Advanced Search parameters, by setting in the **<span style="font-family: 'courier new', courier;">KalturaMetadataSearchItem</span>** to **<span style="font-family: 'courier new', courier;">filter:advancedSearch</span>**, and setting the operator to <span style="font-family: 'courier new', courier;"><strong>SEARCH_OR</strong></span>.

To break a query inside a single field into OR, use the comma operator between the words searched. E.g. to search for all entries who mention either Tech OR Sports, use: "tech,sports" (without the quotes) as your search query. 

<span class="mce-heading-2">NOT operator</span>

To perform a NOT operator, it is possible to use Sphinx's '!' operator – the meaning of the ! operator is AND NOT.  
Search for NOT alone is not possible, every NOT search must first begin with a positive search query.  
For example, setting the <span style="font-family: 'courier new', courier;"><strong>freeText</strong></span> field to: "food !pizza" \---|- will return all entries that contain the word 'food' AND do NOT contain the word 'pizza'.  
<span class="mce-note-graphic">NOTE: Searching for "!pizza" alone will return an ERROR.</span>

This operator as well as quotes (") for exact match, work on all filter text fields in the API.

<p class="mce-heading-2">
  Exact Match
</p>

<p class="p1">
  To search for an exact match, wrap the search query with quotes, for example: 'money ball' will return all entries that contain the string 'money ball' but not entries where money and ball were separated by other characters.
</p>

 
