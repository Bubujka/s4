<?php
def_accessor('s4_bucket');
def_accessor('s4_region', 'eu-west-1');

def_memo('s4', function(){
  return Aws\S3\S3Client::factory(array('region'=>s4_region()));
});

def('s4_delete', function($key){
  return s4()->deleteObject(array('Bucket'=>s4_bucket(), 'Key'=>$key));
});

def('s4_url', function($key){
  return s4()->getObjectUrl(s4_bucket(), $key);
});

def('s4_put', function($key, $body, $ct = null){
  $t = array(
    'Bucket'=>s4_bucket(),
    'Key' => $key,
    'Body' => $body
  );
  if(!is_null($ct))
    $t['ContentType']=$ct;

  return s4()->putObject($t);
});

def('s4_get', function($key){
  $t = array(
    'Bucket'=>s4_bucket(),
    'Key' => $key,
  );
  $t = s4()->getObject($t);
  return $t['Body'];
});

def('s4_put_file', function($key, $pth, $ct = null){
  $t = array(
    'Bucket'=>s4_bucket(),
    'Key' => $key,
    'SourceFile' => $pth
  );
  if(!is_null($ct))
    $t['ContentType']=$ct;

  return s4()->putObject($t);
});

def('s4_list', function($prefix = null){
  $t = array( 'Bucket'=>s4_bucket() );
  if(!is_null($prefix))
    $t['Prefix']=$prefix;

  return s4()->getIterator('listObjects', $t);
});

