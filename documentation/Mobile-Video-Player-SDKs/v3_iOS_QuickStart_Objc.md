---
layout: page
---

## Quick Start Using Obj-C  

In this section, you'll learn how to build a simple video application using the ObjC programming language.

## Create the Project  

### Set Up a Project in Xcode  

1. Open Xcode and click **start new Xcode Project**:
	![help](./v3-images/iOS/newProj.png) 

2. Next, select **Single View Application** and click **Next**:
	![help](./v3-images/iOS/singleView.png) 

3. In the dialog screen displayed, enter the relevant details:
	![help](./v3-images/iOS/projDetails.png) 


### Add the SDK

The simplest way to add the SDK and its dependencies to your project is by using CocoaPods.

>Note: Using CocoaPods on an existing Xcode project will modify the project file, so you may want to make a backup before doing this.

1 . In your project folder, create a plain text file called `Podfile` (no file extension).

2 . Using a text editor, add the following lines of code to the Podfile and save it.

```ruby
	source 'https://github.com/CocoaPods/Specs.git'

	use_frameworks!

	platform :ios, '8.0' # (define required version)

	target 'Simple-Video-Player' do
	pod 'PlayKit'
	end
	
	pre_install do |installer|
    		def installer.verify_no_static_framework_transitive_dependencies; end
	end

	post_install do |installer| 
   		installer.pods_project.targets.each do |target| 
        		target.build_configurations.each do |config| 
                		config.build_settings['SWIFT_VERSION'] = '3.0'
	        		config.build_settings['ALWAYS_EMBED_SWIFT_STANDARD_LIBRARIES'] = 'NO'
        		end 
    		end 
	end

```
	
3 . Navigate to the podfile location via Terminal and type the command:

```ruby
	pod install

```

### Import the Native SDK

Go to the desired file (e.g., `ViewController.swift`) and add the line below:

```objc
	#import "PlayKit-Swift.h"

```

### Code the Video Player Application  

You're now ready to code the video player application using the following options.

**Declare a Player Variable**

```objc
	@property (nonatomic, strong) id<Player> kPlayer;

```

**Set a Player Instance via a Sample Configuration**

```objc
	PlayerConfig *config = [PlayerConfig new];
	NSDictionary *src = @{@"id":@"123123",@"url": @"https://clips.vorwaerts-gmbh.de/big_buck_bunny.mp4"};
    
	NSArray *srcs = @[src];
	NSDictionary *entry = @{@"id":@"Trailer",@"sources": srcs};
    
	[config setWithMediaEntry:[[MediaEntry alloc] initWithJson:entry]];
    
	self.kPlayer = [PlayKitManager.sharedInstance loadPlayerWithConfig:config];

```

>Note: To learn more about `PlayerConfig` Creation, see the [PlayerConfig Doc]() article.

### Setting the Player View Size  

1 . Create a player container: 

```objc
	@property (weak, nonatomic) IBOutlet UIView *playerContainer;

```
2 . Set the player frame and add a player view as a subview:

```objc
	self.kPlayer.view.frame = CGRectMake(0, 0, self.playerContainer.frame.size.width,self.playerContainer.frame.size.height);   
	[self.playerContainer addSubview:self.kPlayer.view];

```

### Adding Custom Buttons and Controls to the Player  

Add custom buttons and controls to the player as follows:

```objc
	- (IBAction)playTapped:(id)sender {
    if(!self.kPlayer.isPlaying) {
        [self.kPlayer play];
    }
	}

	- (IBAction)pauseTapped:(id)sender {
    if(self.kPlayer.isPlaying) {
        [self.kPlayer pause];
	    }
	}

```

> [Download Full Sample]()


</br>
## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.

