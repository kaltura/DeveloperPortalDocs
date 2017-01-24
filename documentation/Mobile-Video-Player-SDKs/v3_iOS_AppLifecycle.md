---
layout: page
---

## Application Lifecycle  

The following section details the iOS application lifecyle.

=== TBD ===

</br>
### Application State Changes

The framework observes application state changes internally to provide better handling.

Handled events:
* On will terminate event:
	* Post analytics "stop" event.

#### Playing Media While in Background

* **Declare your app plays audible content while in the background**. To do this enable in the application background modes section or info.plist .
* **Setting the audio session category**. You must assign an appropriate category to your audio session to ensure your audio plays even with the screen locked.

>swift

```swift
import AVFoundation
import AudioToolbox

let audioSession = AVAudioSession.sharedInstance()

do {
    try audioSession.setCategory(AVAudioSessionCategoryPlayback)
} catch let error as NSError {
    // handle the error condition
}

do {
    try audioSession.setActive(true)
} catch let error as NSError {
    // handle the error condition
}
```
>objc

```objc
#import <AVFoundation/AVFoundation.h>
#import <AudioToolbox/AudioToolbox.h>
 
AVAudioSession *audioSession = [AVAudioSession sharedInstance];
 
NSError *setCategoryError = nil;
BOOL success = [audioSession setCategory:AVAudioSessionCategoryPlayback error:&setCategoryError];
if (!success) { /* handle the error condition */ }
 
NSError *activationError = nil;
success = [audioSession setActive:YES error:&activationError];
if (!success) { /* handle the error condition */ }
```

* **Special considerations for video media**. if current item is displaying video, playback of the Player is automatically paused when the app is sent to the background. to prevent this pause we need to set the player of an AVPlayerLayer to nil.

>swift

```swift
// Remove the AVPlayerLayer from its associated AVPlayer once the app is in the background.
func applicationDidEnterBackground(_ application: UIApplication) {
    let playerView = <#Get your player view#>
    playerView.playerLayer.player = nil
}

// Restore the AVPlayer when the app is active again.
func applicationDidBecomeActive(_ application: UIApplication) {
    let playerView = <#Get your player view#>
    playerView.playerLayer.player = player
}
```
>objc

```objc
// Remove the AVPlayerLayer from its associated AVPlayer once the app is in the background.
- (void)applicationDidEnterBackground:(UIApplication *)application {
  MyPlayerLayerView *playerView = <#Get your player view#>;
  [[playerView playerLayer] setPlayer:nil]; // remove the player
}
 
// Restore the AVPlayer when the app is active again.
- (void)applicationDidBecomeActive:(UIApplication *)application {
  MyPlayerLayerView *playerView = <#Get your player view#>;
  [[playerView playerLayer] setPlayer:_player]; // restore the player
}
```

**note:** the information regarding playing media while in background was taken from [Apple Developer Site](https://developer.apple.com/library/content/qa/qa1668/_index.html)

</br>
### Connectivity


>swift

```swift


```
>objc

```objc


```
</br>
## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
