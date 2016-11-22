 
## Thinking about Live Content  

Live content needs to be thought about a little differently from on-demand content. The main differences are:

* The production and management workflows are different.
* The objective is to deliver content that has time relevancy, for example sport, news, weather, executive announcements, etc. Due to the nature of relevancy, the margin for error on live content is extremely low.
* Live content needs to consistently hold attention, therefore, much thought needs to be put into how content is packaged to make it interesting and relevant to watch. There is a cost associated with this approach.
* Live content can be pulled from different areas - for example content may be licensed or content may be created by your production team. 

## Typical Live Streaming Workflow  

The following displays a high level Live Streaming workflow that is built from 5 main elements:

(![Typical Live Streaming Workflow](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/Live-Video-and-Broadcast/livestreamingworkflow.png)). 

1. **Capture:** A video/audio source (Camera, microphone, etc.) acquired by a capture device, which is a platform in the form of hardware, software, web app or phone app, that enables capturing video and/or audio from various devices.
2. **Encode:** The input video and audio are encoded (compressed) in real-time prior to being processed for streaming. Examples of encoder platforms include:
 * Software solutions, such as FMLE (Flash Media Live Encoder), Telestream Wirecast and OBS (Open Broadcaster Software), etc.
 * Appliances such as NewTek TriCaster, Niagara, TeraDek, VidiU, etc.
 * Rack mounted HW encoders such as Harmonic, Elemental and Envivio
3. **Process:** Processing involves ingesting the live stream from the encoder,  converting the video into multiple display qualities for adaptive streaming, packaging the stream into an adaptive bitrate streaming protocol (such as HLS, MPEG-DASH, MSS), optionally encrypting the content and delivering the packaged content to the consumption device/player typically via a CDN (Content Delivery Network) .
4. **Deliver:** Delivery of the processed video fragments to the end users can be challenging from a scaling perspective. CDNs such as Akamai and CloudFront are used to distribute the content to virtually any number of users globally using caching servers spread in multiple points of presence.
5. **Consume:** Almost every device is video capable today. The video is displayed within a video player on multiple platforms such as laptops, desktops, smartphones, tablets, game consols and TVs. 

If you would like to learn more about live streaming terminology, concepts and technology, you can have a look at this video.

## Adaptive Bitrate (ABR) Streaming  
 
Adaptive bitrate streaming is a technique used in streaming multimedia over IP networks. While in the past most video streaming technologies utilized streaming protocols such as RTP with RTSP, today's adaptive streaming technologies are almost exclusively based on HTTP and designed to work efficiently over large distributed HTTP networks such as the Internet.
 
Adaptive bitrate solves 3 main problems that existed on video streaming over the internet:

* Provides a good user experience for different clients/devices with different video capabilities (resolution, bitrate, etc)
* Provides a good user experience for varied and fluctuating internet connection speed (bandwidth)
* Provides protocols that can easily traverse the internet without having problems with firewalls, NAT ,etc.

Adaptive bitrate is the process by which the same content is prepared in multiple renditions (flavors) that fits the various resolutions of playing devices and the different available bandwidths. During live playback, the player fetches the correct flavor (bitrate) to the viewer according to the viewer's internet connection speed and device capabilities. When and if there is a change in the the available bandwidth during the live stream, the player senses the change and seamlessly switches to a higher/lower rendition, providing a better user experience to the viewer and minimizing buffering time.
 
Adaptive bitrate streaming provides consumers of streaming media with the best-possible experience, since the media server automatically adapts to any changes in each user's network and playback conditions.  Adaptive bitrate technology requires additional encoding, but simplifies the overall workflow and creates better results.
In addition, HTTP-based adaptive bitrate streaming technologies yield additional benefits over traditional server-driven adaptive bitrate streaming. First, since the streaming technology is built on top of HTTP, contrary to RTP-based adaptive streaming, the packets have no difficulties traversing firewall and NAT devices. Second, since HTTP streaming is purely client-driven, all adaptation logic resides at the client. This reduces the requirement of persistent connections between server and client application. Furthermore, the server is not required to maintain session state information on each client, increasing scalability. Finally, existing HTTP delivery infrastructure, such as HTTP caches and servers can be seamlessly adopted.

## Kaltura Live Streaming  

The Kaltura live streaming platform enables you to broadcast live events or 24/7 channels to any screen. A Kaltura live stream can be provisioned in the Kaltura Management Console ( KMC ) or using the Kaltura live API.

Kaltura live streaming simplifies live streaming by providing a wide set of capabilities and flexible configuration. The highlighted features of the Kaltura live platform are:
Fully SaaS live platform - No need to install or maintain anything on premise. Kaltura takes care of the infrastructure and keeps you up-to-date with new devices and technologies.
24/7 channels and live events - Broadcast 24/7 live channels and live events over the internet in a simple & cost-effective manner
Play on any device - Use Kaltura or a 3rd party player to provide access to your live stream on any device - PC's, laptops, TV's, mobile devices, tables, game consoles, etc.
Deliver to any audience size -  Kaltura live streams can be delivered through a Content Delivery Network (CDN) such as Akamai, as well as support internal delivery in diverse network topologies with support for eCDNs and Multicast.
Service high availability - Geo-redundancy and in-data-center redundancy provides no single point of failure to ensure your live broadcast is not interrupted.
Instant provisioning  — Streams are provisioned instantly without delays both in the KMC and via API calls. 
Cloud Transcoding — Supports single RTMP stream ingest being transcoded in the cloud to a few different flavors for high quality adaptive bitrate delivery experience with minimal ingest bandwidth and CPU requirements.
Pass through - Supports multi-bitrate RTMP streams ingest, processing and delivery to any screen for cases when the original encoder output should not be manipulated and bandwidth is not an issue.
Live Recording and Live to VOD — Records your live broadcast for instant VOD access once the live event is complete via the same embed code.
DVR window - Allows your viewers to seek back through the live event and see parts they've missed.
To start your first live stream with Kaltura Live, refer to Getting started with Kaltura Live Streaming.


