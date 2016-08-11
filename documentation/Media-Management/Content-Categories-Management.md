---
layout: page
title: Content Categories Management
weight: 102
---

Media entries can be organized in categories. Categories are structured in a tree-like hierarchy where each category can include multiple sub-categories.  
You can add, remove and edit categories using the [category service](https://developer.kaltura.com/api-docs/#/category). You can assign a media entry to a specific category using the [categoryEntry service](https://developer.kaltura.com/api-docs/#/categoryEntry).   
Categories provide a logical structure for your site and assist with content management. You can assign custom metadata to categories. Then, using filters you can create robust search and discovery workflows, playlists and more.  
Categories may also be used to set content entitlements for end-users in various applications using the [categoryUser service](https://developer.kaltura.com/api-docs/#/categoryUser).  

### Quick Summary - Categories     

* A category is a metadata that groups content. 
* Media entries can be added into categories. Each entry can be associated with up to 32 categories (If you need more, please [contact us](mailto:vpaas.kaltura.com)).
* Categories are built in a tree-like hierarchy where each category can include multiple sub-categories.
* Each category may only have a single parent category, or be a root level category (no parent).
* Categories provide a logical taxonomy structure for your site or application and assist with content management. 
* You can use categories, along with metadata and filters to create manually or dynamically generated playlists.
* Categories can be used for setting content entitlements for end-users, regulating access to content and functionality.

> **Backward Compatability** - The [KalturaBaseEntry](https://developer.kaltura.com/api-docs/#/KalturaBaseEntry) exposes the two properties `categories` and `categoriesIds`. These properties can only be used when your categories are not configured with Entitlement settings. It is always best to rely on the `categoryEntry` service to retrieve a full list of categories per Entry. Avoid using the `categories` and `categoriesIds` properties.

## Creating and Managing Categories

To add, list, delete, edit, move and manage categories, use the [`category service`](https://developer.kaltura.com/api-docs/#/category).

* Categories are always associated with an owner user ID. This is the user who created the category (determined by the Kaltura Session used when calling [`category.add`](https://developer.kaltura.com/api-docs/#/category.add)).
* To retrieve a category's full parent's tree path (until the root parent) use	the	[KalturaCategory.fullName](https://developer.kaltura.com/api-docs/#/KalturaCategory) and [KalturaCategory.fullIds](https://developer.kaltura.com/api-docs/#/KalturaCategory) fields.

## Managing Entries Inside Categories  

With a category structure in place, use the [`categoryEntry service`](https://developer.kaltura.com/api-docs/#/categoryEntry) to add, delete and move entries in and out of categories.

To add an entry to a category, simply call the [categoryEntry.add](https://developer.kaltura.com/api-docs/#/categoryEntry.add) providing a [KalturaCategoryEntry](https://developer.kaltura.com/api-docs/#/KalturaCategoryEntry) object. In the `KalturaCategoryEntry` object, set the id of the entry and the id of the category you want to associate it to.  

To remove an entry from a category, call the [categoryEntry.delete](https://developer.kaltura.com/api-docs/#/categoryEntry.delete) action and provide the id of the entry (`entryId`) and the id of the category (`categoryId`) from which to remove the entry.

## Category Content Moderation   

By default, every entry may be added to a category, however, you may choose to moderate content.  
Setting the `moderation` property to 1 (true) places new entries into a virtual moderation queue. Entries in the moderation queue must be approved by a user with Manager or Moderator permission level, before they are officially associated with the category.  

The membership of users in a category is defined with the [categoryUser](https://developer.kaltura.com/api-docs/#/categoryUser) service. Use the `add` action to associate a user with a category.  

The relationship of user permissions in a specific category is configured with the `permissionLevel` property when calling the [`categoryUser.add`](https://developer.kaltura.com/api-docs/#/categoryUser.add) action. (The options for `permissionLevel` are available in [`KalturaCategoryUserPermissionLevel`](https://developer.kaltura.com/api-docs/#/KalturaCategoryUserPermissionLevel)).  

Moderation is governed with the [categoryEntry.activate](https://developer.kaltura.com/api-docs/#/categoryEntry.activate) and [categoryEntry.reject](https://developer.kaltura.com/api-docs/#/categoryEntry.reject) actions, that allow moderator users to approve (`activate`) or reject the addition of an entry to the category.

The [`contributionPolicy`](https://developer.kaltura.com/api-docs/#/KalturaCategory) determines if users are required to have a contributor level permission to be allowed to add or even suggest entries to the category. By default, all users are allowed to contribute (suggest) entries to be added. By setting the `contributionPolicy` to [`KalturaContributionPolicyType.MEMBERS_WITH_CONTRIBUTION_PERMISSION`](https://developer.kaltura.com/api-docs/#/KalturaContributionPolicyType), only users that are given a contributor role or above will be allowed to suggest entries.  

Use the [`userJoinPolicy`](https://developer.kaltura.com/api-docs/#/KalturaCategory) and [`KalturaUserJoinPolicyType`](https://developer.kaltura.com/api-docs/#/KalturaUserJoinPolicyType) to set whether users:
* can add themselves to the category (`AUTO_JOIN`)
* can request to be added and wait for themoderator's approval (`REQUEST_TO_JOIN`) 
* or if it's a by-invitation only list and users are not allowed to ask to be added (`NOT_ALLOWED`).  
If the category is set to moderated membership approval (`REQUEST_TO_JOIN`), use the `activate` action to approve the moderated request to join. If a user should not be allowed join, use `deactivate` action to reject a user's request to join the category.

## Managing End-User Content Entitlements

Content Entitlements is a method to allow end users access to a group of content items (entries).  
Entitlements are configured on the category level by setting a special unique key to identify the applicative context in which to allow or deny access to the category's entries.  

Applications such as [Kaltura MediaSpace](http://corp.kaltura.com/Products/Video-Applications/Kaltura-Mediaspace-Video-Portal) implement entitlements to achieve the concept of "Authenticated Content Channels".
Example use-cases based on content entitlements:
- group collaboration based on channel membership
- premium content - get access to channels/categories based on a paid subscription 


### The Content Privacy Options

Content Privacy defines the visibility of content associated with a category, including its related metadata.   

Content Privacy determines:  

* Who has access to content associated with the category
* Whether the content will be available to the user in global search results (e.g. when calling [`media.list`](https://developer.kaltura.com/api-docs/#/media.list))

Content Privacy is configured in the Category's [privacy](https://developer.kaltura.com/api-docs/#/KalturaCategory) property. The available options are defined in [`KalturaPrivacyType`](https://developer.kaltura.com/api-docs/#/KalturaPrivacyType). 

#### Available options for `privacy`:

* `ALL` (No Restriction) – Content in the category is visible to everyone with access to the application it is published in. For example, setting a media gallery that is open on the web and be accessible by everyone, including anonymous viewers.  
* `AUTHENTICATED_USERS` (Authentication Required) – Content in the category is visible only to authenticated end-users (calls with a valid Kaltura Session that specifies a userId. Anonymous users will not be allowed to see these entries).  
* `MEMBERS_ONLY` (Private) – Content in this category is visible only to users with specific permission to access this category's content and to the owner of the content. This option is relevant for setting "private channels" that are available only to a group of users.  

> Note: With any content privacy option, the owner of the content is always entitled to access and manage their content.  

## Visibility of Content Associated with Multiple Categories 

For content associated with more than one category, the privacy and visibility of this content via global
search (e.g. using `media.list`) or a direct call to `baseEntry.get`, is determined based on the category with the lowest restriction level the content is associated with (within the application category tree).   

If an entry is associated with a category where privacy is set to `MEMBERS_ONLY`, and another category where privacy is set to `ALL` - the entry will be accessible to everyone (both via `get` or `list` actions) regardless of the definition set in the `MEMBERS_ONLY` category.

## Entitlement Enforcement Behavior

To configure how Kaltura enforces entitlement and handles entitlement conflicts, use the [`defaultEntitlementEnforcement`](https://developer.kaltura.com/api-docs/#/KalturaPartner) property of `KalturaPartner`.

* When `defaultEntitlementEnforcement` is set to true (default): Access to content under categories where privacy and privacyContext are configured is only allowed for API calls that provide a KS (Kaltura Session) that specify the correct privacyContext and a userId that is a member of the category.
* When `defaultEntitlementEnforcement` is set to false: Access to content under categories with entitlement is possible using any valid Kaltura Session, including anonymous player embed codes (using a Widget Session). With this option, the application itself is responsible to implement an entitlement enforcement and it is expected that entitlement rules are kept within the application. 

> To learn more about how entitlements are enforced, please read: [Content Entitlements and Privacy Enforcement](/documentation/Content-Entitlements-Privacy-Enforcement.html).  

## Category Discoverability in Search

Categories expose properties to control whether to, and who can find the categories and the entries associated with them. 

[privacy](https://developer.kaltura.com/api-docs/#/KalturaCategory), defined to one of its ENUM options [`KalturaPrivacyType`](https://developer.kaltura.com/api-docs/#/KalturaPrivacyType) sets whether entries that are associated with the category can be seen by users: 

* ALL: Category will be visible to all users.
* AUTHENTICATED_USERS: Category will only be visible to logged-in users (i.e. List API requests made with a USER or ADMIN KS that specify a userId that is not null).
* MEMBERS_ONLY: Category will only be visible to users that are accepted members of the category. (i.e. A categoryUser object exists that connects the categoryId with the userId specified in the KS used to call the list API.)

### Configure and Use Content Entitlements

To configure entitlements on a category, you will need to set a "Privacy Context" ([`category.privacyContext`](https://developer.kaltura.com/api-docs/#/KalturaCategory) propetry) for the desired category.  
Privacy Context is a free text label (English character string; commas and spaces are not allowed) that indicates to which application the entitlement settings apply, for example, “MySuperAwesomeVideoApp”.

To allow access to an entitled category, follow these steps: 

1. The end user must be added as a member of the category by using the [`CategoryUser`](https://developer.kaltura.com/api-docs/#/categoryUser) service. 
2. The privacy context should be passed in the application session (KS) whenever making API requests in the [`privacycontext` KS privileges](https://knowledge.kaltura.com/node/229#privacycontext).  

> `privacyContexts` provides a means to set multiple entitlement application contexts per category with comma-seperated list of unique keys.
The Privacy Context configuration for an application guarantees the following:
User’s entitlements to content in the application are determined based on the specific categories the application is integrated with. 
Categories that are not directly integrated with the application can be used for any content organization and applicative classification purposes. A content item can be shared with such categories with no impact on their visibility to end-users through the application.
In the common case, a single Privacy Context should be set to an entire ‘branch’ within the category-tree, and indicate the application integrated with it. In more complex scenarios, multiple privacy contexts can be set to categories to enable access to content shared between multiple applications within the account, and under the same organizational context.

