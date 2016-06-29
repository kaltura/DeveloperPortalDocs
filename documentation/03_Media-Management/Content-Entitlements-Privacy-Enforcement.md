---
layout: page
title: Content Entitlements and Privacy Enforcement
type: header
---

Content Entitlements is a method to govern access of end-users to groups of content items (entries) using categories.  
Entitlements are configured on the category level by setting a special unique key to identify the applicative context in which to allow access to the category's entries.  

Applications such as [Kaltura MediaSpace](http://corp.kaltura.com/Products/Video-Applications/Kaltura-Mediaspace-Video-Portal) implement entitlements to achieve the concept of "Authenticated Content Channels" where users can securely collaborate on content that only they have access to, or, paid categories where access to premmium content galleries is only allowed to users who subscribed for the category.  
To learn about how to configure and work with Content Entitlements read the [Categories and Content Entitlements article](Categories-and-Content-Entitlements.md).  

The diagram below outlines the rules based on which Kaltura enforces content entitlements.  
Depending on your desired application behavior, you can configure the Kaltura system to be more restrictive or open in allowing access to your assets.  

{% plantuml %}
@startuml
skinparam shadowing false
skinparam activityBorderColor #444444
skinparam activityArrowColor #444444
if (**entitlements** has been **disabled**\nspecifically for this entry\nby the **widget or feed services**) then (yes)
-[#blue]->
    #DeepSkyBlue:Entry is allowed]
    detach
endif
-[#DarkRed]-> no;
if (**defaultEntitlementEnforcement**\nis set to **FALSE** on the account) then (yes)
-[#blue]->
    #DeepSkyBlue:Entry is allowed]
    detach
endif
-[#DarkRed]-> no;
if (**ks** has **disableentitlement** permission\nOR\n**disableentitlementforentry == entryId**) then (yes)
-[#blue]->
    #DeepSkyBlue:Entry is allowed]
    detach
endif
-[#DarkRed]-> no;
if (The user (ks.userId) is\n**owner** of the entry) then (yes)
-[#blue]->
    #DeepSkyBlue:Entry is allowed]
    detach
endif
-[#DarkRed]-> no;
if (The user (ks.userId) has\n**edit or publish permission** on the entry) then (yes)
-[#blue]->
    #DeepSkyBlue:Entry is allowed]
    detach
endif
-[#DarkRed]-> no;
if (Entry is **associated** with \none or more **categories**) then (yes)
-[#blue]->
    if (On **all** of the entry's categories:\n **privacyContext == null**) then (yes)
    -[#blue]->
    #DeepSkyBlue:Entry is allowed]
    detach
endif
-[#DarkRed]-> no;
if (**ks.privacycontext**\nequal to one of the\nentry's categories' privacyContext) then (yes)
-[#blue]->
    #DeepSkyBlue:Entry is allowed]
    detach
endif
-[#DarkRed]-> no;
if (**category.privacy** is set to\n**MEMBERS_ONLY**) then (yes)
-[#blue]->
    if (**ks.userId** is a\n**member** of the category) then (yes)
    -[#blue]->
        #DeepSkyBlue:Entry is allowed]
        detach
    else (no)
    -[#DarkRed]->
        #DarkRed:Entry denied]
        detach
    endif
else (category.privacy\nset to\nAUTHENTICATED) 
    -[#blue]->
        #DeepSkyBlue:Entry is allowed]
        detach
endif
else (Entry NOT\nassociated\nwith catrgories)
    -[#blue]->
    #DeepSkyBlue:Entry is allowed]
    detach
endif
@enduml
{% endplantuml %}
