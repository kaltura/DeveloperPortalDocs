---
layout: page
---

AvAudioSession enables you to control the audio on iOS devices even when the silent switch is off. This article describes the steps required to enable you to control the audio output in iOS devices using AVAudioSession.

## Set AVAudioSession to Play Audio  

The AVAudioSession enables you to play audio (essentially any sound) even when the silent switch is off.

1. When you begin playing the video, keep the initial category value of AVAudioSession aside.
2. Change the actual category value to AVAudioSessionCategoryPlayback as follows:

```swift
var audioSessionInitialCategory: String?

//-----

audioSessionInitialCategory = AVAudioSession.sharedInstance().category
do {
    try AVAudioSession.sharedInstance().setCategory(AVAudioSessionCategoryPlayback)
} catch {
    audioSessionInitialCategory = nil
}
```

**Note:** When the video is finished, you may return the initial category value as follows:

```swift
if let _ = audioSessionInitialCategory {
   do {
        try AVAudioSession.sharedInstance().setCategory(audioSessionInitialCategory!)
   } catch {
   }
}
```


## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
