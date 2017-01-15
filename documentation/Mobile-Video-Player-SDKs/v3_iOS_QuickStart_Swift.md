---
layout: page
title: Quick Start Using Swift
subcat: SDK 3.0 (Beta) - iOS
weight: 292
---

# Quick Start Using Swift

Build a Simple Video App using the Swift programming language.

## Create the project


### Set up a project in Xcode 

Open Xcode. Click start new Xcode Project:

![help](./v3-images/iOS/newProj.png) 

Once you have done this, Select: **Single View Application** and click the Next button.

![help](./v3-images/iOS/singleView.png) 

Now you will be presented with another dialogue screen enter in the details you wish.

![help](./v3-images/iOS/projDetails.png) 


### Add the SDK

The way to add the SDK and its dependencies to your project is to use CocoaPods.

>Note: Using CocoaPods on an existing Xcode project will modify the project file. You may want to make a backup before doing this.

* In your project folder, create a plain text file called Podfile (no file extension).
* Using a text editor, add the following lines of code to the Podfile and save it.

```
source 'https://github.com/CocoaPods/Specs.git'

use_frameworks!

platform :ios, '8.0' # (define required version)

target 'Simple-Video-Player' do
  pod 'PlayKit'
end

# needed for swift
pre_install do |installer|
    def installer.verify_no_static_framework_transitive_dependencies; end
end

# needed for swift
post_install do |installer| 
    installer.pods_project.targets.each do |target| 
        target.build_configurations.each do |config| 
            config.build_settings['ALWAYS_EMBED_SWIFT_STANDARD_LIBRARIES'] = 'NO'
            config.build_settings['OTHER_SWIFT_FLAGS'] = '-Xfrontend -warn-long-function-bodies=100'
        end 
    end 
end


```
Navigate to Podfile location via Terminal and type the command

```
pod install

```

>Notice the last line, which is **important** "from this point on, you must open the Video-Player.xcworkspace file in Xcode, not the Video-Player.xcodeproj file."

### Import the Native SDK

Go to desired file (e.g ViewController.swift) and put below line

```
import PlayKit

```

### Code the video player app

* To declare a player variable, use:

```
var playerController: Player

```

* To set a player instance via a sample configuration, use:

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

To set the player view size:

* Create a player container: 

```
@IBOutlet weak var playerContainer: UIView!

```
* Set Player frame and Add a player view as a subview:

```
self.playerController.view.frame = playerContainer.bounds
playerContainer.addSubview(self.playerController.view)

```

### Control Player

* Add custom buttons and controls to the player as follows:

```
@IBAction func playClicked(_ sender: AnyObject) {
	self.playerController.play()
}
    
@IBAction func pauseClicked(_ sender: AnyObject) {
	self.playerController.pause()
}

```


> [Download Full Sample]()


**Having Issues?**

> We have a [Questions and Answer Forum](https://forum.kaltura.org/c/playkit) where you can ask your iOS Development questions.