---
layout: page
title: Troubleshooting
---

## iOS: App Transport Security (ATS)
iOS 9 and above include a security feature that, by default, blocks all non-TLS connections.
However, since many servers still don't support TLS, there are exclusion keys that can be set in the
app's `Info.plist` file.

The most permissive setting is to entirely disable ATS. This is done by setting
`NSAppTransportSecurity:NSAllowsArbitraryLoads` to `YES`:

```xml
<plist version="1.0">
<dict>
	...
	<key>NSAppTransportSecurity</key>
	<dict>
		<key>NSAllowsArbitraryLoads</key>
		<true/>
	</dict>
	...
</dict>
</plist>
```

**NOTE**: If there's a known limited set of domains that have to be accessed without TLS, it is advised to explicitly
whitelist them. For more information about fine-grained control of ATS see:
* https://developer.apple.com/library/ios/documentation/General/Reference/InfoPlistKeyReference/Articles/CocoaKeys.html#//apple_ref/doc/plist/info/NSAppTransportSecurity
* http://www.neglectedpotential.com/2015/06/working-with-apples-application-transport-security/

## iOS: Bitcode
Starting with [Xcode 7](https://developer.apple.com/library/ios/releasenotes/DeveloperTools/RN-Xcode/Chapters/xc7_release_notes.html)
bitcode is enabled by default. However, building an app with bitcode requires that all used static
libraries are also built with bitcode.

The Widevine Classic library (`libWViPhoneAPI.a`) included with the Kaltura SDK is not built with bitcode; as a result,
your app has to disable bitcode in its own linker settings.


