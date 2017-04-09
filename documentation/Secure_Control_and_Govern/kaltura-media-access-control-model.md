---
layout: page
title: The Kaltura Media Access Control Model
weight: 105
---

An Access Control Profile defines authorized and restricted domains where your content can or cannot be displayed, countries from which it can or cannot be viewed, white and black lists of IP addresses and authorized and unauthorized domains and devices in which your media can be embedded.

For information on Kaltura session-based restrictions, refer to [Kaltura's API Authentication and Security][1]. 

 [1]: http://knowledge.kaltura.com/node/229

### <span></span>Access Control API

The access control API service <a href="https://developer.kaltura.com/api-docs/#/accessControlProfile" target="_blank">accessControlProfile</a>  provides the following actions:

**<a href="https://developer.kaltura.com/api-docs/#/accessControlProfile" target="_blank">accessControlProfile</a>**

*   <a href="https://developer.kaltura.com/api-docs/#/accessControlProfile.add" target="_blank">addAction</a>
*   <a href="https://developer.kaltura.com/api-docs/#/accessControlProfile.get" target="_blank">getAction</a>
*   [updateAction][2]
*   <a href="https://developer.kaltura.com/api-docs/#/accessControlProfile.delete" target="_blank">deleteAction</a>
*   <a href="https://developer.kaltura.com/api-docs/#/accessControlProfile.list" target="_blank">listAction</a>

 [2]: https://developer.kaltura.com/api-docs/#/accessControlProfile.update

**<a href="https://developer.kaltura.com/api-docs/#/KalturaAccessControlProfile" target="_blank">KalturaAccessControlProfile </a>**

The API object <a href="https://developer.kaltura.com/api-docs/#/KalturaAccessControlProfile" target="_blank">KalturaAccessControlProfile </a>is composed of an ordered set of rules of type <a href="https://developer.kaltura.com/api-docs/#/KalturaRule" target="_blank">KalturaRule</a>.

<p class="Subheading">
  <a href="https://developer.kaltura.com/api-docs/#/KalturaRule" target="_blank">KalturaRule</a>
</p>

The KalturaRule type contains the following attributes:

<table style="width: 693px;" border="0" cellpadding="0">
  <tbody>
    <tr>
      <td style="text-align: left;">
        <strong>Name</strong>
      </td>
      
      <td style="text-align: left;">
        <strong>Type</strong>
      </td>
      
      <td>
        <strong>Writable</strong>
      </td>
      
      <td>
        <p style="text-align: left;">
          <strong>Description</strong>
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          actions
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          <a href="https://developer.kaltura.com/api-docs/#/KalturaAccessControlActionArray" target="_blank">KalturaAccessControlActionArray</a>
        </p>
      </td>
      
      <td>
        <p>
          <span>V</span>
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          Actions to be performed by the player in case the rule is fulfilled.
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          conditions
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          <a href="https://developer.kaltura.com/api-docs/#/KalturaConditionArray" target="_blank">KalturaConditionArray</a>
        </p>
      </td>
      
      <td>
        <p>
          V
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          Conditions to validate the rule.
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          contexts
        </p>
      </td>
      
      <td>
        <p>
          <a href="https://developer.kaltura.com/api-docs/#/KalturaAccessControlContextTypeHolderArray" target="_blank">KalturaAccessControlContextTypeHolderArray</a>
        </p>
      </td>
      
      <td>
        <p>
          V
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          Indicates what contexts should be tested by this rule. 
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          message
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          string
        </p>
      </td>
      
      <td>
        <p>
          V
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          Message to be thrown to the player in case the rule is fulfilled.
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p>
          stopProcessing
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          boolean
        </p>
      </td>
      
      <td>
        <p>
          V
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          Indicates that when this rule has been met there is no need to continue checking the rest of the rules. 
        </p>
      </td>
    </tr>
  </tbody>
</table>

Rules are evaluated according to their order and evaluated only if they are configured to run in the current context, according to their contexts attribute. A KalturaRule is considered  fulfilled only if all its conditions are evaluated as true. The available context types are in the[ KalturaAccessControlContextType][3].

 [3]: https://developer.kaltura.com/api-docs/#/KalturaAccessControlContextType

**KalturaAccessControlContextType**

<table style="width: 485px;" border="0" cellpadding="0">
  <tbody>
    <tr>
      <td>
        <p style="text-align: left;">
          <strong>Name</strong>
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          <strong>Type</strong>
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          <strong>Value</strong>
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          DOWNLOAD
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          string
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          2
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          PLAY
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          string
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          1
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          <span style="text-decoration: line-through;"></span>THUMBNAIL
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          string
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          3
        </p>
      </td>
    </tr>
  </tbody>
</table>

All rules are evaluated, unless one of the rule's stop processing flag is true and the rule condition was fulfilled. Each rule that matches the conditions, adds the actions to the outcome actions and its message to the outcome messages. All of the actions are performed for rules that are evaluated and their conditions are true. Each rule is composed of a set of conditions <a href="https://developer.kaltura.com/api-docs/#/KalturaConditionArray" target="_blank">KalturaCondition</a>  and an action [KalturaAccessControlAction.][4]  The action types are described in <a href="https://developer.kaltura.com/api-docs/#/KalturaAccessControlActionType" target="_blank">KalturaAccessControlActionType. </a>The logical relation between the set of conditions in a single rule uses the AND operator, meaning that all conditions must be evaluated to true in order to consider the rule as fulfilled.

 [4]: https://developer.kaltura.com/api-docs/#/KalturaAccessControlAction

<p class="Subheading">
  <a href="https://developer.kaltura.com/api-docs/#/KalturaConditionArray" target="_blank">KalturaCondition </a>
</p>

The condition types are:

<p class="Subheading">
  <a href="https://developer.kaltura.com/api-docs/#/KalturaConditionArray" target="_blank">KalturaConditionType</a> 
</p>

<table border="0" cellpadding="0">
  <tbody>
    <tr>
      <td style="text-align: left;">
        <strong>Name</strong>
      </td>
      
      <td style="text-align: left;">
        <strong>Type</strong>
      </td>
      
      <td>
        <strong>Value</strong>
      </td>
      
      <td>
        <p style="text-align: left;">
          <strong>Description</strong>
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;">
        AUTHENTICATED 
      </td>
      
      <td>
        <p>
          <span>string</span>
        </p>
      </td>
      
      <td style="text-align: left;">
         1
      </td>
      
      <td>
        <p style="text-align: left;">
          <span>Validate that the user is authenticated, specific privileges may be defined.</span>
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          COUNTRY
        </p>
      </td>
      
      <td>
        <p>
          <span>string</span>
        </p>
      </td>
      
      <td style="text-align: left;">
         2
      </td>
      
      <td>
        <p style="text-align: left;">
          <span>Validate that the request came from a specific country, calculated according to request IP.</span>
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          FIELD_COMPARE 
        </p>
      </td>
      
      <td style="text-align: left;">
        <span>string</span>
      </td>
      
      <td>
        <p style="text-align: left;">
           7
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          <span>Validate that the field number compared correctly to all listed numeric values.</span>
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          FIELD_MATCH
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          <span>string</span>
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
           6
        </p>
      </td>
      
      <td style="text-align: left;">
        Validate that the field text matches any of listed textual values. 
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;">
        IP_ADDRESS 
      </td>
      
      <td style="text-align: left;">
        <span>string</span> 
      </td>
      
      <td style="text-align: left;">
         3
      </td>
      
      <td style="text-align: left;">
        <span>Validate that the request came from a specific IP range.</span>
      </td>
    </tr>
    
    <tr>
      <td>
        METADATA_FIELD_COMPARE 
      </td>
      
      <td style="text-align: left;">
        <span>string</span>
      </td>
      
      <td style="text-align: left;">
        metadata.FieldCompare 
      </td>
      
      <td style="text-align: left;">
        Validate that all metadata elements number compared correctly to all listed numeric values. 
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;">
        METADATA_FIELD_MATCH
      </td>
      
      <td style="text-align: left;">
        <span>string</span> 
      </td>
      
      <td style="text-align: left;">
        metadata.FieldMatch 
      </td>
      
      <td style="text-align: left;">
        Validate that any of the metadata elements text matches any of listed textual values. 
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;">
        SITE
      </td>
      
      <td style="text-align: left;">
        <span>string</span>
      </td>
      
      <td style="text-align: left;">
         4
      </td>
      
      <td style="text-align: left;">
        <span>Validate that the request came from a specific domain, wildcards are supported.</span> 
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;">
        USER_AGENT
      </td>
      
      <td style="text-align: left;">
        <span>string</span> 
      </td>
      
      <td style="text-align: left;">
         5
      </td>
      
      <td style="text-align: left;">
        <span>Validate that the request came from a specific user agent, regular expressions are supported.</span> 
      </td>
    </tr>
  </tbody>
</table>

 The objects available that implement the condition objects are:

*   <a href="https://developer.kaltura.com/api-docs/#/KalturaAuthenticatedCondition" target="_blank">KalturaAuthenticatedCondition</a> **Note: **This object should be configured only on an entry level access control objects.
*   <a href="https://developer.kaltura.com/api-docs/#/KalturaCompareMetadataCondition" target="_blank">KalturaCompareMetadataCondition</a>
*   <a href="https://developer.kaltura.com/api-docs/#/KalturaFieldCompareCondition" target="_blank">KalturaFieldCompareCondition</a>
*   [KalturaCountryCondition][5]
*   <a href="https://developer.kaltura.com/api-docs/#/KalturaFieldMatchCondition" target="_blank">KalturaFieldMatchCondition</a>
*   <a href="https://developer.kaltura.com/api-docs/#/KalturaIpAddressCondition" target="_blank">KalturaIpAddressCondition</a>
*   <a href="https://developer.kaltura.com/api-docs/#/KalturaMatchMetadataCondition" target="_blank">KalturaMatchMetadataCondition</a>
*   <a href="https://developer.kaltura.com/api-docs/#/KalturaUserAgentCondition" target="_blank">KalturaUserAgentCondition</a>
*   <a href="https://developer.kaltura.com/api-docs/#/KalturaSiteCondition" target="_blank">KalturaSiteCondition</a>

 [5]: https://developer.kaltura.com/api-docs/#/KalturaCountryCondition

For example:

Rule #1 – conditions: KS is not valid -> action: block

Rule #2 – conditions: country is not US -> action: block

If no rule applies, no action will be taken and the content will be allowed.

**Understanding the Compare and Match Condition Objects** 

FIELD_COMPARE<span> </span>and FIELD_MATCH<span> </span>differentiate generic fields from generic values. A field is any implementation of [KalturaStringField][6] for textual matching or [KalturaIntegerField][7] for numeric comparison.

 [6]: #KalturaStringField
 [7]: #KalturaIntegerField

<a name="KalturaStringField"></a>KalturaStringField implementations:

*   KalturaCountryContextField – Represents the current request's country context as calculated based on the IP address.
*   KalturaIpAddressContextField – Represents the current request's IP address context.
*   KalturaUserAgentContextField – Represents the current request's user agent context.
*   KalturaUserEmailContextField – Represents the current session's user e-mail address context.
*   KalturaEvalStringField (Falcon only: Requires Admin Console permission) – Evaluates a PHP statement, depends on the execution context.

<a name="KalturaIntegerField"></a>KalturaIntegerField implementations:

*   KalturaTimeContextField – Represents the current time context on Kaltura servers.

FIELD\_COMPARE and FIELD\_MATCH use [KalturaIntegerValue][8] for numeric comparison values and [KalturaStringValue][9] for textual matches.

 [8]: #KalturaIntegerValue
 [9]: #KalturaStringValue

<a name="KalturaIntegerValue"></a>KalturaIntegerValue may contain a numeric value or may be implemented as [KalturaIntegerField][7].

<a name="KalturaStringValue"></a>KalturaStringValue may contain a string value or may be implemented as [KalturaStringField][6].

METADATA\_FIELD\_COMPARE<span> and <span>METADATA_FIELD_MATCH </span></span>also use [KalturaIntegerValue][8] and [KalturaStringValue][9] for sets of values. For the metadata condition objects, the field used is from the metadata fields of a specific xPath in the metadata XML (instead of the field object).

The profile ID attribute indicates the metadata profile ID to use.

The xPath attribute may contain the full xPath to the field in the following formats:

*   xPath with a slash  
    For example:  /metadata/myElementName
*   Using a local name function   
    For example: /\*[local-name()='metadata']/\*[local-name()='myElementName']
*   Using only the field name  
    For example: myElementName will be searched as //myElementName

**KalturaAccessControlActionType**

The following set of actions are defined:

1.  **KalturaAccessControlBlockAction - **Block access
2.  **KalturaAccessControlPreviewAction - **Preview – play only the first X seconds of a video

**<a href="https://developer.kaltura.com/api-docs/#/KalturaAccessControlScope" target="_blank">KalturaAccessControlScope</a>**

The **<a href="https://developer.kaltura.com/api-docs/#/KalturaAccessControlScope" target="_blank">KalturaAccessControlScope</a>**API contains a predefined list of context variables: 

<table style="width: 892px;" border="0" cellpadding="0">
  <tbody>
    <tr>
      <td>
        <p style="text-align: left;">
          <strong>Name</strong>
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          <strong>Type</strong>
        </p>
      </td>
      
      <td>
        <p>
          <strong>Writable</strong>
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          <strong>Description</strong>
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          contexts
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          <a href="https://developer.kaltura.com/api-docs/#/KalturaAccessControlContextTypeHolderArray" target="_blank">KalturaAccessControlContextTypeHolderArray</a>
        </p>
      </td>
      
      <td>
        <p>
          V
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          Indicates what contexts should be tested. No context means any context.
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          ip
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          string
        </p>
      </td>
      
      <td>
        <p>
          V
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          IP to be used to test geographic location conditions.
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          ks
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          string
        </p>
      </td>
      
      <td>
        <p>
          V
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          Kaltura session to be used to test session and user conditions.
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          referrer
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          string
        </p>
      </td>
      
      <td>
        <p>
          V
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          URL to be used to test domain conditions.
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          time
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          int
        </p>
      </td>
      
      <td>
        <p>
          V
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          Unix timestamp (in seconds) to be used to test entry scheduling, keep null to use now.
        </p>
      </td>
    </tr>
    
    <tr>
      <td>
        <p style="text-align: left;">
          userAgent
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          string
        </p>
      </td>
      
      <td>
        <p>
          V
        </p>
      </td>
      
      <td>
        <p style="text-align: left;">
          Browser or client application to be used to test agent conditions.
        </p>
      </td>
    </tr>
  </tbody>
</table>

<div>
  <hr width="33%" size="1" />
  
  <div>
    <h2>
      Examples
    </h2>
    
    <p>
      The following examples are in PHP and effectively will be the same across all client libraries. 
    </p>
    
    <p>
      Note that the xpath property may contain the full xpath to the field in three formats:
    </p>
    
    <ul>
      <li>
        Slashed xPath, e.g. /metadata/myElementName
      </li>
      <li>
        Using local-name function, e.g. /*[local-name()='metadata']/*[local-name()='myElementName']
      </li>
      <li>
        Using only the field name, e.g. myElementName, it will be searched as //myElementName
      </li>
    </ul>
    
    <h3>
      Device-specific scheduling window
    </h3>
    
    <p>
      Condition #1: User agent MATCH 'ipad' (regular expression)
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$value1 = new KalturaStringValue();
$value1-&gt;value = '.*ipad.*';
$condition1 = new KalturaUserAgentCondition();
$condition1-&gt;values = array($value1);</pre>
    
    <p>
      Condition #2: Current time => entry’s {metadata_123/ipadSunrise}
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$condition2 = new KalturaCompareMetadataCondition();
$condition2-&gt;comparison = KalturaSearchConditionComparison::LESS_THAN_OR_EQUAL;
$condition2-&gt;xPath = 'ipadSunrise';
$condition2-&gt;profileId = 123;
$condition2-&gt;value = new KalturaTimeContextField();</pre>
    
    <p>
      Condition #3: Current time <= entry’s {metadata_123/ipadSunset}
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$condition3 = new KalturaCompareMetadataCondition();
$condition3-&gt;comparison = KalturaSearchConditionComparison::GREATER_THAN_OR_EQUAL;
$condition3-&gt;xPath = 'ipadSunset';
$condition3-&gt;profileId = 123;
$condition3-&gt;value = new KalturaTimeContextField();</pre>
    
    <p>
      Actions: none
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$rule-&gt;conditions = array($condition1, $condition2, $condition3);
$rule-&gt;stopProcessing = true;</pre>
    
    <p>
      The next rule should be defined with no conditions and one block action in order to block all requests that didn’t stop processing on the first rule.
    </p>
    
    <h3>
      Block long-form content on mobile devices
    </h3>
    
    <p>
      Condition #1: User agent MATCH ‘Mobile devices of brands X, Y, Z’ (regular expression)
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$value1 = new KalturaStringValue();
$value1-&gt;value = '.*X.*';
$value2 = new KalturaStringValue();
$value2-&gt;value = '.*Y.*';
$value3 = new KalturaStringValue();
$value3-&gt;value = '.*Z.*';
$condition1 = new KalturaUserAgentCondition();
$condition1-&gt;values = array($value1, $value2, $value3);</pre>
    
    <p>
      Condition #2: Entry’s {metadata_123/FormatType} Equals ‘Long Form’
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$value1 = new KalturaStringValue();
$value1-&gt;value = 'Long Form';
$condition2 = new KalturaMatchMetadataCondition();
$condition2-&gt;xPath = 'FormatType';
$condition2-&gt;profileId = 123;
$condition2-&gt;values = array($value1);
$rule-&gt;conditions = array($condition1, $condition2);</pre>
    
    <p>
      Actions: Block
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$rule-&gt;actions = array(new KalturaAccessControlBlockAction());</pre>
    
    <h3>
      Block language-specific content for consumers in a specific geography
    </h3>
    
    <p>
      Condition #1: Region Equals Quebec* (First phase will be limited to countries)
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$value1 = new KalturaStringValue();
$value1-&gt;value = 'Quebec';
$condition1 = new KalturaCountryCondition();
$condition1-&gt;values = array($value1);</pre>
    
    <p>
      Condition #2: entry’s {metadata_123/AudioLanguage} NOT Equals ‘French’
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$value1 = new KalturaStringValue();
$value1-&gt;value = ‘French';
$condition2 = new KalturaMatchMetadataCondition();
$condition2-&gt;xPath = 'AudioLanguage';
$condition2-&gt;profileId = 123;
$condition2-&gt;values = array($value1);
$condition2-&gt;not = true;</pre>
    
    <p>
      Actions: Block
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$rule-&gt;actions = array(new KalturaAccessControlBlockAction());</pre>
    
    <h3>
      Block content for unidentified devices
    </h3>
    
    <p>
      Condition #1: User agent NOT MATCH ‘Mobile devices of brands X, Y, Z’ (regular expression)
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$value1 = new KalturaStringValue();
$value1-&gt;value = '.*X.*';
$value2 = new KalturaStringValue();
$value2-&gt;value = '.*Y.*';
$value3 = new KalturaStringValue();
$value3-&gt;value = '.*Z.*';
$condition1 = new KalturaUserAgentCondition();
$condition1-&gt;values = array($value1, $value2, $value3);
$condition1-&gt;not = true;</pre>
    
    <p>
      Actions: Block
    </p>
    
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$rule-&gt;actions = array(new KalturaAccessControlBlockAction());</pre>
  </div>
</div>
