//
//  showNoticesViewController.h
//  UNLRSS
//
//  Created by Franco Agustín Rabaglia on 19/02/14.
//  Copyright (c) 2014 Franco Agustín Rabaglia. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface showNoticesViewController : UIViewController <UIWebViewDelegate>
@property (nonatomic, strong) UIBarButtonItem *shareButton;
@property (weak, nonatomic) IBOutlet UILabel *titleTextLabel;
@property (weak, nonatomic) IBOutlet UILabel *descriptionTextLabel;
@property (weak, nonatomic) IBOutlet UIWebView *bodyHTMLView;
@property (weak, nonatomic) IBOutlet UIWebView *imageHTMLView;
@property (nonatomic,strong) NSString *titleSegue;
@property (nonatomic,strong) NSString *descriptionSegue;
@property (nonatomic,strong) NSString *imageUrl;
@property (nonatomic,strong) NSString *bodySegue;


@property (nonatomic,strong) UIActivityViewController *activityVC;


- (void) callFacebookSharing;
- (void) callTwitterSharing;
@end
