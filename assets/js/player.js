var flashvars =
	{
	autostart:            'false',
	repeat:               'false',
	controlbar:           'bottom',
	stretching:			  'uniform',
	image: 				  '',
	file:                 BASE_URI +'playlist/'+ CLIENT_ID,
	bufferlength:		  '15',
	playlist:			  'bottom',
	playlistsize:		  '200',
	backcolor:			  'EEEEEE',
	lightcolor: 		  '888888'
};

var params =
	{
	allowscriptaccess:    'always',
	allowfullscreen:      'true',
	wmode:			      'opaque'
};

var attributes =
	{
	name:                 'playerId',
	id:                   'playerId'
};
swfobject.embedSWF(BASE_URI +"player.swf", "video", "680", "715", "10.0.0", BASE_URI+"expressInstall.swf", flashvars, params, attributes);