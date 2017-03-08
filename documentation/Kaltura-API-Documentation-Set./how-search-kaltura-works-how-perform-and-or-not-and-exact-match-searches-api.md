---
layout: page
title: How to perform AND, OR, NOT and Exact Match searches in API
---

## Background  

Kaltura uses the [Open Source Search Server Sphinx](http://sphinxsearch.com) to perform its metadata indexing and search. The Kaltura Search API and Custom Metadata Search API provide an abstraction layer on top of the Sphinx's search capabilities.

>Note: We recommend reading [Kaltura Search Engine for Media, Metadata and Timeline: Search Behavior and Commands](http://knowledge.kaltura.com/node/247) for more details on the topic of search operators and behavior in Kaltura.

## OR and AND operators  

For the base metadata (name, tags, description, entryId, etc.), the system only provides an AND operator. To run an OR query on the base metadata, the following search filter should be used: ``filter:freeText``.  
The freeText filter performs an OR search across the following base entry fields: name, tags, description, entry\_id, reference\_id, roots, puser_id.

When searching Custom Metadata fields, it is possible to control the search operator when setting the Advanced Search parameters, by setting in the ``KalturaMetadataSearchItem`` to ``filter:advancedSearch``and setting the operator to ``SEARCH_OR``.

To break a query inside a single field into OR, use the comma operator between the words searched. E.g., to search for all entries that mention either Tech OR Sports, use: "tech,sports" (without the quotes) as your search query. 

## NOT operator  

To perform a NOT operator, it is possible to use Sphinx's '!' operator – the meaning of the ! operator is AND NOT.  
Search for NOT alone is not possible, every NOT search must first begin with a positive search query.  
For example, setting the ``freeText</strong`` field to: "food !pizza" \---|- will return all entries that contain the word 'food' AND do NOT contain the word 'pizza'.  

> Note: Searching for "!pizza" alone will return an ERROR.

This operator as well as quotes (") for exact match, work on all filter text fields in the API.

## Exact Match  

To search for an exact match, wrap the search query with quotes, for example: 'money ball' will return all entries that contain the string 'money ball' but not entries where money and ball were separated by other characters.

 
