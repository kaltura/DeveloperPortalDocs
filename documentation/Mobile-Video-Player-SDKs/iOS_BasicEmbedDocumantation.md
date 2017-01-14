---
layout: page
title: iOS Basic Embed Documentation
subcat: SDK 3.0 (Beta) - iOS
weight: 293
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/playkit-ios)

This section includes samples for basic player operations such as configuration. For additional examples, see the [PlayKit Full Featured Demo Application](https://github.com/kaltura/playkit-ios-demo).

>Note: For an Objective C example, see the PlayKit ObjC Basic Embed.

## Setting Up Using Cocoapods

1. Add a `pod 'PlayKit'` file similar to the following to your Podfile:

    `pod 'PlayKit'`

2. Because the Playkit SDK is written in Swift, you'll need to attach the following to the bottom of your Podfile:
    
    ```
    pre_install do |installer|
      def installer.verify_no_static_framework_transitive_dependencies; end
    end

    post_install do |installer|
      installer.pods_project.targets.each do |target|
         target.build_configurations.each do |config|
                config.build_settings['ALWAYS_EMBED_SWIFT_STANDARD_LIBRARIES'] = 'NO'
         end
      end
    end
    ```
> Note: For a complete Podfile sample go to [PlayKit Demo Podfile](https://github.com/kaltura/playkit-ios-demo/blob/master/Podfile) and then run a `pod install` command inside your terminal, or from the CocoaPods.application.

## Declaring a Player Variable  

To declare a player variable, use:

    ```
    var playerController: Player
    ```

## Setting a Player Instance via Sample Configuration  

To set a player instance via a sample configuration, use:

    ```
    let config = PlayerConfig()
        
        var source = [String : Any]()
        source["id"] = "123123" //"http://media.w3.org/2010/05/sintel/trailer.mp4"
        source["url"] = "https://devimages.apple.com.edgekey.net/streaming/examples/bipbop_16x9/bipbop_16x9_variant.m3u8"
        
        var sources = [JSON]()
        sources.append(JSON(source))
        
        var entry = [String : Any]()
        entry["id"] = "Trailer"
        entry["sources"] = sources
        
        config.set(mediaEntry: MediaEntry(json: JSON(entry)))//.set(allowPlayerEngineExpose: kAllowAVPlayerExpose)
        
        // Here we get the player
        self.playerController = PlayKitManager.sharedInstance.loadPlayer(config: config)

    ```

>Note: To learn more about `PlayerConfig` Creation, see the [PlayerConfig Doc]() article.

## Setting the Player View Size  

To set the player view size:

1. Create a player container: 

    ```
    @IBOutlet weak var playerView: UIView!
    ```
2. Add a player view as a subview:

    ```
    playerView.addSubview(self.playerController.view)
    ```

## Control Player - Basic Player Actions  

Add custom buttons and controls to the player as follows:

    ```
    @IBAction func playClicked(_ sender: AnyObject) {
        self.playerController.play()
       }
    
    @IBAction func pauseClicked(_ sender: AnyObject) {
        self.playerController.pause()
      }
    
    @IBAction func playheadValueChanged(_ sender: AnyObject) {
        if (!sender.isKind(of: UISlider.self)) {
            return
         }
        let slider = sender as! UISlider
        playerController.seek(to: CMTimeMake(Int64(slider.value), 1))
     }
    ```

> See the [Basic Sample](https://github.com/kaltura/playkit-ios-samples) for additional references.
> Be focused on the PlayKit Sample

## Additional Features

| Feature Name |                                                           Documentation                                                           |
|--------------|:---------------------------------------------------------------------------------------------------------------------------------:|
| Google Ads   | [IMA](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/iOS_Ads.html)                               |
| Cast         | [Chromecast](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/iOS_GoogleCast.html)  and [AirPlay](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/iOS_AirPlay.html) |
| Analytics    | [KalturaStatsPlugin](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/iOS_KalturaStatsPlugin.html) |
| DRM          | [FairPlay]()  [Widevine]()                                                                                                  |
| Live         | [Live Edge](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/iOS_Live.html)                        |
| Tracks       | [Audio & Subtitles Tracks](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/iOS_Tracks.html)       |
| Audio Mode   |      [Control Audio Mode](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/iOS_AudioMode.html)     |
