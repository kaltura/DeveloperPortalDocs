---
layout: page
title: Categories and Metadata Management
type: header
---

## Introduction to Categories

* A category is a metadata field that groups content. 
* Media entries can be added into categories. 
* Categories are built in a tree-like hierarchy where each category can include multiple sub-categories.
* Categories provide a logical taxonomy structure for your site or application and assist with content management. 
* You can use categories, along with metadata and filters to create manually or dynamically generated playlists.
* Categories can also be used for setting content entitlements to end-users, regulating access to contetn and functionality.

>**Knowledge Article:** [How to create categories and assign entries to a category in the KMC](http://knowledge.kaltura.com/faq/how-create-categories-and-assign-entries-category-kmc#categories)

## Category API Workflows

To add, list, delete, edit, move and manage categories, use the [`category service`](https://www.kaltura.com/api_v3/testmeDoc/index.php?service=category).

With a category structure in place, use the [`categoryEntry service`](https://www.kaltura.com/api_v3/testmeDoc/index.php?service=categoryEntry) to add, delete and move entries in and out of categories.

When entitlements are used, categories offer control over user-access to content. In this case, use the [`CategoryUser service`](https://www.kaltura.com/api_v3/testmeDoc/index.php?service=categoryUser) to add, delete and move users in and out of categories. 

>Entitlements workflows are covered in detail [here](#)

In the service examples above, there are several more actions that can be applied so be sure to take a look at the links for more info.

## Introduction to Metadata

* Kaltura supports multiple types of metadata fields including text, date, and list-of-values (controlled lists).
* All metadata supports either a single value or multiple values. 
* Kaltura also supports a special type of field called Linked Entries (Entry-id List), which allows assigning a video to a group of related videos.
* Textual metadata fields are indexed in Kaltura’s search engine, while list-of-values can be used as custom filters in playlists and media queries.
* Custom fields can easily be added through the KMC via one or more *custom metadata schemas*.
* Advanced custom metadata capabilities are available via Kaltura APIs.

>**Knowledge Article:** [Custom Metadata Use Cases](http://knowledge.kaltura.com/custom-metadata-use-cases#metadata)

## Metadata API Workflows

The [`metadata service`](https://www.kaltura.com/api_v3/testmeDoc/index.php?service=metadata_metadata) provides actions to add, delete, get, update, and index metadata in Kaltura. Be sure to visit the link for a full list of actions.

### Metadata Recipe
Generate code for common metadata-centric workflows using the recipe below:
[RECIPE EMBED](x)

Be sure to check out our full [recipe library](http://developers.kaltura.org) for more workflow tools.
