---
layout: page
title: Quick Start Using Obj-C
subcat: SDK 3.0 (Beta) - iOS
weight: 292
---

# Quick Start Using Obj-C

Build a Simple Video App using the Obj-C programming language.

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

```
Navigate to Podfile location via Terminal and type the command

```
pod install

```

>Notice the last line, which is **important** "from this point on, you must open the Video-Player.xcworkspace file in Xcode, not the Video-Player.xcodeproj file."

### Import the Native SDK

Go to desired file (e.g ViewController.h) and put below line

```

```

### Code the video player app

* To declare a player variable, use:

```


```

* To set a player instance via a sample configuration, use:

```

```

>Note: To learn more about `PlayerConfig` Creation, see the [PlayerConfig Doc]() article.

To set the player view size:

* Create a player container: 

```


```
* Set Player frame and Add a player view as a subview:

```

```

### Control Player

* Add custom buttons and controls to the player as follows:

```

```


> [Download Full Sample]()


**Having Issues?**

> We have a [Questions and Answer Forum](https://forum.kaltura.org/c/playkit) where you can ask your iOS Development questions.