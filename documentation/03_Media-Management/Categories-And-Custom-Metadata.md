---
layout: page
title: Categories and Metadata Management
type: header
---

Media entries can be organized in categories, which are structured in a tree-like hierarchy where each category can include multiple sub-categories.

You can add, remove and edit categories using the [category service](https://developer.kaltura.com/api-docs/#/category). Additionally, you can assign a media entry to a specific category using the [categoryEntry service](https://developer.kaltura.com/api-docs/#/categoryEntry).   

Categories provide a logical structure for your site and assist with content management. You can assign custom metadata to categories. Then, using filters, you can create robust search and discovery workflows, playlists and more. Categories may also be used for setting content entitlements to end-users in various applications.  

### Quick Summary - Categories  

* A category is a metadata that groups content. 
* Media entries can be added into categories. Each entry can be associated with up to 32 categories (if you need additional categories, please [contact us](mailto:vpaas.kaltura.com)).
* Categories are built in a tree-like hierarchy where each category can include multiple sub-categories.
* Categories provide a logical taxonomy structure for your site or application and assist with content management. 
* You can use categories, along with metadata and filters, to create manual or dynamically-generated playlists.
* Categories can also be used for setting content entitlements to end-users, regulating access to content, and functionality.

> See the **knowledge article** [How to create categories and assign entries to a category in the KMC](http://knowledge.kaltura.com/faq/how-create-categories-and-assign-entries-category-kmc#categories) for more information.

## Category API Workflows  

To add, list, delete, edit, move and manage categories, use the [`category service`](https://www.kaltura.com/api_v3/testmeDoc/index.php?service=category).

With a category structure in place, use the [`categoryEntry service`](https://www.kaltura.com/api_v3/testmeDoc/index.php?service=categoryEntry) to add, delete and move entries in and out of categories.

When entitlements are used, categories offer control over user-access to content. In this case, use the [`CategoryUser service`](https://www.kaltura.com/api_v3/testmeDoc/index.php?service=categoryUser) to add, delete and move users in and out of categories. 

> Entitlements workflows are covered in detail [here](#).

In the service examples above, there are several more actions that can be applied, so make sure to take a look at the links for more information.

## Using Metadata  

* Kaltura supports multiple types of metadata fields including text, date, and list-of-values (controlled lists).
* All metadata supports either a single value or multiple values. 
* Kaltura also supports a special type of field called Linked Entries (Entry-id List), which allows assigning a video to a group of related videos.
* Textual metadata fields are indexed in Kaltura’s search engine, while list-of-values can be used as custom filters in playlists and media queries.
* Custom fields can be added easily through the KMC using one or more *custom metadata schemas*.
* Advanced custom metadata capabilities are available via the Kaltura APIs.

> See the **knowledge article** [Custom Metadata Use Cases](http://knowledge.kaltura.com/custom-metadata-use-cases#metadata) for more information.

## Metadata API Workflows

The [`metadata service`](https://www.kaltura.com/api_v3/testmeDoc/index.php?service=metadata_metadata) provides actions for adding, deleting, getting, updating, and indexing metadata in Kaltura. Be sure to visit the link for a full list of actions.

### Metadata Recipe  

Generate code for common metadata-centric workflows using the recipe below:

{% onebox https://developer.kaltura.com/recipes/metadata/embed#/start %}

