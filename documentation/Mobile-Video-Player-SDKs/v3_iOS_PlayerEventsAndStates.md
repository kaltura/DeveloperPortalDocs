---
layout: page
---

# Player Events & States

In order to get notified about any player-related events or states, you can add observers to relevant events.

### Events Observation

>swift

```swift


```
>objc

```objc


```

>Note: To get full supported player events list please review [PlayerEvents](https://kaltura.github.io/playkit/api/ios/Classes/PlayerEvents.html)

### States Observation

>swift

```swift


```
>objc

```objc


```

>Note: To get full supported player states list please review [PlayerStates	](https://kaltura.github.io/playkit/api/ios/Enums/PlayerState.html)

The Protocol provides delegate methods for each callback; for more information please review the JWPlayerDelegate.h file in the SDK package.

Every callback notification has an “event” name in the userInfo dictionary, together with the additional parameters described below.

**Having Issues?**

> We have a [Questions and Answer Forum](https://forum.kaltura.org/c/playkit) where you can ask your iOS Development questions.