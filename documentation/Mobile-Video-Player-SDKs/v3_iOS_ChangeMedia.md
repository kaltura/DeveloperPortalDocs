---
layout: page
---

## Change Media

This document describes the steps required to change media. 

When it is needed to change media we have to destroy the player and recreate it. 
The important things to make sure is when adding the player back to the view hierarchy we need to provide is with a frame and when removing the player we need to make sure to call destroy + removing player view.

When creating the player:

>swift

```swift
// playerContainer is the view holding the player view
self.playerContainer.addSubview(self.player.view)
self.player.view.frame = self.playerContainer.bounds
```
>objc

```objc
// playerContainer is the view holding the player view
[self.playerContainer addSubview:self.player.view];
self.player.view.frame = self.playerContainer.bounds;
```

When destroying the player:

>swift

```swift
self.player.view.removeFromSuperview()
self.player.destroy()
self.player = nil
// now you can create the player again with your own method.
```
>objc

```objc
[self.player.view removeFromSuperview];
[self.player destroy];
self.player = nil;
// now you can create the player again with your own method.
```

## Code Sample

[PlayKit iOS samples](https://github.com/kaltura/playkit-ios-samples) repo has a dedicated samples with more details.

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
