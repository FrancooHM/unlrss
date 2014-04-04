//
//  showNoticesViewController.m
//  UNLRSS
//
//  Created by Franco Agustín Rabaglia on 19/02/14.
//  Copyright (c) 2014 Franco Agustín Rabaglia. All rights reserved.
//

#import "showNoticesViewController.h"
#import <Social/Social.h>
#import "Configs.h"

@interface showNoticesViewController ()

@end

@implementation showNoticesViewController
@synthesize shareButton;
@synthesize titleSegue;
@synthesize descriptionSegue;
@synthesize bodySegue;
@synthesize titleTextLabel;
@synthesize descriptionTextLabel;
@synthesize imageUrl;
@synthesize bodyHTMLView;
@synthesize imageHTMLView;
@synthesize activityVC;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    //This line is for delegating the bodyHTMLView (UIWebView) to this class.
    bodyHTMLView.delegate = self;
    
	// Do any additional setup after loading the view.
    //Setting configs of textLabels.
    
    titleTextLabel.numberOfLines = 0;
    descriptionTextLabel.numberOfLines = 0;
    
    descriptionTextLabel.textColor = greyColor;
    
    //Setting content.
    self.title = @"UNL Media";
    self.titleTextLabel.text = self.titleSegue;
    self.descriptionTextLabel.text = self.descriptionSegue;
    
    [titleTextLabel setFont:boldFont];
    
    NSString *myImageTag = [NSString stringWithFormat:@"<html> \n"
                            "<body><img src='%@' width='%d' style='position:absolute;left:0px;top:0px;opacity:0.75;'></body> \n"
                            "</html>",self.imageUrl, imageW];
    
    NSString *myDescriptionHTML = [NSString stringWithFormat:@"<html> \n"
                         "<head> \n"
                         "<style type=\"text/css\"> \n"
                         "body {font-family: \"%@\"; font-size: %d;}\n"
                         "</style> \n"
                         "</head> \n"
                         "<body>%@</body> \n"
                         "</html>", @"helvetica", 15, bodySegue];
    
    NSLog(@"myImageTag : %@",myImageTag);
    NSLog(@"imageUrl : %@",self.imageUrl);
    
    if ([self.imageUrl  isEqual: @""]) {

        
            titleTextLabel.textColor = aquaColor;
        
        imageHTMLView.alpha = 0;
    }
    else{

        //Setting title with image
        titleTextLabel.textColor = whiteColor;
        imageHTMLView.alpha = 1;
        [imageHTMLView loadHTMLString:myImageTag baseURL:nil];
        [titleTextLabel setShadowColor:blackColor];
        [titleTextLabel setShadowOffset: shadowOffsetDefault];

    }

    
    //Setting body on UIWebView (HTML).
    [bodyHTMLView loadHTMLString:myDescriptionHTML baseURL:nil];
    
    shareButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemAction target:self action:@selector(shareButtonAction)];
    self.navigationItem.rightBarButtonItem = shareButton;
    
    
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

//UIWebViewDelagate:
//This function handle any clicked link callback. (So it opens a safary browser instead showing the content in the UIWebView).
-(BOOL)webView:(UIWebView *)webView shouldStartLoadWithRequest:(NSURLRequest *)request navigationType:(UIWebViewNavigationType)navigationType {
    if (navigationType == UIWebViewNavigationTypeLinkClicked) {
        [[UIApplication sharedApplication] openURL:[request URL]];
        return NO;
    }
    return YES;
}


- (void) createShareWindow{
    
    
    NSString *shareString =  [self.titleTextLabel.text stringByAppendingFormat:@" #UNLMedia"];
    
    NSArray *activityItems = [NSArray arrayWithObjects:shareString, nil, nil, nil];
    
    UIActivityViewController *activityViewController = [[UIActivityViewController alloc] initWithActivityItems:activityItems applicationActivities:nil];
    activityViewController.modalTransitionStyle = UIModalTransitionStyleCoverVertical;
    
    [self presentViewController:activityViewController animated:YES completion:nil];
}

- (IBAction)shareButtonAction {

    [self createShareWindow];
    
    NSLog(@"trying to add subview!");
}

@end
