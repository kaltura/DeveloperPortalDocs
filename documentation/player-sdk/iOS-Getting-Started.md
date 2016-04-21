---
layout: page
title: iOS Player SDK Getting Started 
---



## Getting Started

KalturaPlayerSDK can be added to any project (big or small) in a matter of minutes (maybe even seconds if you're super speedy). 

To install Kaltura iOS player SDK there are 2 options:

* CocoaPods is fully supported

* SDK Traditional Installation




## SDK CocoaPods Installation :

The easiest way to install KalturaPlayerSDK is to use [CocoaPods](https://cocoapods.org/). To do so, simply add the following line to your Podfile:

```
pod 'KalturaPlayerSDK'
```




## SDK Traditional Installation :

```
git clone https://github.com/kaltura/player-sdk-native-ios.git
```

### Add the static library's .xcodeproj to the app's project
Find the ```KALTURAPlayerSDK.xcodeproj``` from the subproject folder in Finder, and drag it into Xcode’s Navigator tree. Alternatively, add it with Xcode’s Add Files File menu item.

![add xcodeproj](https://camo.githubusercontent.com/1e3d845d0728b62beb23e474ae30d2b8370867db/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f6164645f66696c65732e706e67)


Make sure to add the ```KALTURAPlayerSDK.xcodeproj``` file only, **not the entire directory**. You can’t have the same project open in two different Xcode windows.If you find that you’re unable to navigate around the library project, check that you don’t have it open in another Xcode window. After you’ve added the subproject, it should appear below the main project in the Xcode’s Navigator tree:
![Xcode navigator tree](https://camo.githubusercontent.com/1f46c83ca7f3e9c76f1509ddc041e3964e63f3c7/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f78636f6465747265652e706e67)

## Configure the app target to build the static library target.

1. You will need to get the main project to build and link to the ```KALTURAPlayerSDK``` library.
2. In the main project app’s target settings, find the ```Build Phases``` section. This is where you’ll configure the ```KALTURAPlayerSDK``` target to automatically build and link to the ```KALTURAPlayerSDK ``` library.
3. After you’ve found the ```Build Phases``` section, open the ```Target Dependencies``` block and click the ```+```button. In the hierarchy presented to you, the ```KALTURAPlayerSDK``` target from the ```KALTURAPlayerSDK``` project should be listed. Select it and click ```add```

![Xcode target config](https://camo.githubusercontent.com/d35c79ce9a0d01ad3a45a94362da413ed4afa403/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f616464446570656e64656e6369652e6a7067)

## Configure the app target to link to the static library target.
1. You will need to set the app to link to the library when it’s built - just like you would a system framework you would want to use. Open the ```Link Binary With Libraries``` section located a bit below the ```Target Dependencies``` section, and click ```+``` in there too. At the top of the list there should be the ```libKALTURAPlayerSDK.a``` static library that the main project target produces. Choose it and click ```Add```.
![Xcode target config2](https://camo.githubusercontent.com/acea3bcfbe47b0cc2e37796807d23c617723822f/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f6c696e6b546f53444b2e6a7067)

2. Because we are using Objective-C, we have to add a couple of linker flags to the main project app’s target to ensure that ObjC static libraries like ours are linked correctly. In the main project target’s ```Build Settings``` find the ```Other Linker Flags``` line, and add ```-ObjC``` 
![Xcode objC flag](https://camo.githubusercontent.com/a79c30cac8e6ff20b85c2db05391fb5888706966/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f616464696e674f626a435f666c61672e6a7067)

### Adding Resources Bundle

1. Choose the app target from the Targets section.
2. Go to the ```Products``` folder and drag the ```KALTURAPlayerSDK.bundle``` to ```Copy Bundle Resources``` section.

![Adding resource bundle](https://camo.githubusercontent.com/bd7958d4ca8e7c7ce8ca1dac1a6b1c1c6c08c078/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f42756e646c652e706e67)

** If you click build now, you will see that the PlayerSDK library is built before the main project app, and they are linked together.**

### Required Frameworks
```
• SystemConfiguration
• QuartzCore
• CoreMedia
• AVFoundation
• AudioToolbox
• AdSupport
• WebKit
• Social
• MediaAccessibility
• libSystem.dylib
• libz.dylib
• libstdc++.dylib
• libstdc++.6.dylib
• libstdc++.6.0.9.dylib
• libxml2.dylib
• libxml2.2.dylib
• libc++.dylib
```

### App Transport Security 
For inforamtion about the Application Transport Security, 
