<?php
defined("BASEPATH") or exit('No direct script access allowed.');
date_default_timezone_set("Asia/Kolkata");

class Check_master 
{
	protected $CI;
	public function __construct()
	{
		$this->CI=& get_instance();
		$this->CI->load->model('Model_Db');
	}
	public function validate($request){
		try{
            $data=array();
            if(isset($request->labelid) && $request->labelid>0 && $request->labelid!=null){
                switch ($request->labelid){
                    case 1:
                        if(isset($request->txtAc)&& $request->txtAc>0 && $request->txtAc!=null){
                            $data['masterid']=4;
                            $data['mastercode']=$request->txtAc;
                            $data['status']=true;
                        }else if(isset($request->txtPc)&& $request->txtPc>0 && $request->txtPc!=null){
                            $data['masterid']=2;
                            $data['mastercode']=$request->txtPc;
                            $data['status']=true;
                        }else if(isset($request->txtZilla)&& $request->txtZilla>0 && $request->txtZilla!=null){
                            $data['masterid']=3;
                            $data['mastercode']=$request->txtZilla;
                            $data['status']=true;
                        }else{
                            $data['masterid']=1;
                            $data['mastercode']=1;
                            $data['status']=true;
                        }
                        break;
                    case 2:
                        if(isset($request->txtZilla)&& $request->txtZilla>0 && $request->txtZilla!=null){
                            $data['masterid']=3;
                            $data['mastercode']=$request->txtZilla;
                            $data['status']=true;
                        }else{
                            $data['status']=false;
                            $data['title']="Alert!!";
                            $data['status']="Zilla code not found";
                        }
                        break;
                    case 3:
                        if(isset($request->txtMandal)&& $request->txtMandal>0 && $request->txtMandal!=null){
                            $data['masterid']=5;
                            $data['mastercode']=$request->txtMandal;
                            $data['status']=true;
                        }else{
                            $data['status']=false;
                            $data['title']="Alert!!";
                            $data['status']="Mandal code not found";
                        }
                        break;
                    case 4:
                        if(isset($request->txtShakti)&& $request->txtShakti>0 && $request->txtShakti!=null){
                            $data['masterid']=6;
                            $data['mastercode']=$request->txtShakti;
                            $data['status']=true;
                        }else{
                            $data['status']=false;
                            $data['title']="Alert!!";
                            $data['status']="Shaktikendra code not found";
                        }
                        break;
                    case 5:
                        if(isset($request->txtBooth)&& $request->txtBooth>0 && $request->txtBooth!=null){
                            $data['masterid']=7;
                            $data['mastercode']=$request->txtBooth;
                            $data['status']=true;
                        }else{
                            $data['status']=false;
                            $data['title']="Alert!!";
                            $data['status']="Booth code not found";
                        }
                        break;
                }
            }else{
                $data['status']=false;
            }
           return $data;
		}catch (Exception $e){
			$data['message']= $e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
		}
	}
	public function report($request){
		try{
		    $data=array();
		    if(isset($request['txtAc'])){
                $ac=$request['txtAc'];
            }
            if(isset($request['txtPc'])){
                $pc=$request['txtPc'];
            }
            if(isset($request['txtZilla'])){
                $zilla=$request['txtZilla'];
            }
            if(isset($request['txtMandal'])){
                $mandal=$request['txtMandal'];
            }
            if(isset($request['txtShakti'])){
                $shakti=$request['txtShakti'];
            }
            if(isset($request['txtBooth'])){
                $booth=$request['txtBooth'];
            }
           if(isset($request['labelid']) && $request['labelid']>0 && $request['labelid']!=null){
               $where="";
               $labelid = $request['labelid'];
               switch ($labelid){
                   case 1:
                       if(isset($ac)&& $ac>0 && $ac!=null){
                           $data['where']="tpd.masterid=4 and tpd.mastercode=$ac";
                           $data['header']="Ac name";
                       }else if(isset($pc)&& $pc>0 && $pc!=null){
                           $data['where']="tpd.masterid=2 and tpd.mastercode=$pc";
                           $data['header']="Pc name";
                       }else if(isset($zilla)&& $zilla>0 && $zilla!=null){
                           $data['where']="tpd.masterid=3 and tpd.mastercode=$zilla";
                           $data['header']="Zilla name";
                       }else{
                           $data['where']="";
                       }
                       break;
                   case 2:
                       if(isset($zilla)&& $zilla>0 && $zilla!=null){
                           $data['where']="tpd.masterid=3 and tpd.mastercode=$zilla";
                           $data['header']="Zilla name";
                       }else{
                           $data['where']="";
                       }
                       break;
                   case 3:
                       if(isset($mandal)&& $mandal>0 && $mandal!=null){
                           $data['where']="tpd.masterid=5 and tpd.mastercode=$mandal";
                           $data['header']="Mandal name";
                       }else{
                           $data['where']="";
                       }
                       break;
                   case 4:
                       if(isset($shakti)&& $shakti>0 && $shakti!=null){
                           $data['where']="tpd.masterid=6 and tpd.mastercode=$shakti";
                           $data['header']="Shaktikendra name";
                       }else{
                           $data['where']="";
                       }
                       break;
                   case 5:
                       if(isset($booth)&& $booth>0 && $booth!=null){
                           $data['where']="tpd.masterid=7 and tpd.mastercode=$booth";
                           $data['header']="Booth name";
                       }else{
                           $data['where']="";
                       }
                       break;
                   }
           }else{
               $data['where']="";
           }
           return $data;
		}catch (Exception $e){
			$data['message']= $e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
		}
	}
	public function master_details_report($request){
		try{
		    $data=array();
		    if(isset($request['txtAc'])){
                $ac=$request['txtAc'];
            }
            if(isset($request['txtPc'])){
                $pc=$request['txtPc'];
            }
            if(isset($request['txtZilla'])){
                $zilla=$request['txtZilla'];
            }
            if(isset($request['txtMandal'])){
                $mandal=$request['txtMandal'];
            }
            if(isset($request['txtShakti'])){
                $shakti=$request['txtShakti'];
            }
            if(isset($request['txtBooth'])){
                $booth=$request['txtBooth'];
            }
           if(isset($request['labelid']) && $request['labelid']>0 && $request['labelid']!=null){
               $labelid = $request['labelid'];
               switch ($labelid){
                   case 1:
                   	if(isset($request['txtSubunit'])){
						if($request['txtSubunit'] == 7){
							if(isset($pc)&& $pc>0 && $pc!=null){
								$where_pc="id=$pc";
							}else {
								$where_pc="isactive=true";
							}
							$data['pc']=$this->CI->Model_Db->select(12,null,$where_pc);
							$data['columns']=array('Pc Name');
							break;
						}elseif ($request['txtSubunit'] == 8){
							if(isset($ac)&& count($ac)>0 && $ac!=null){
								$where_ac="";
								foreach ($ac as $key => $value) 
								{
									if ($key>0) 
									{
										$where_ac.=" or id=$value";
									}else{
                                        $where_ac.="id=$value";
									}
									
								}
								
							}else {
								$where_ac = "isactive=true";
							}
							$data['ac']=$this->CI->Model_Db->select(40,null,$where_ac);
							$data['columns']=array('Pc Name','Ac Name');
							break;
						}
					}
                       if(isset($zilla)&& $zilla>0 && $zilla!=null){
                           $w_zilla="id=$zilla";
                       }else{
                           $w_zilla="isactive=true";
                       }
                       $data['zilla']=$this->CI->Model_Db->select(22,null,$w_zilla);
//                  $data['columns']=array('Pc Name','Ac Name','Zilla Name');
                       $data['columns']=array('Zilla Name');
                       break;
                   case 2:
                       if(isset($zilla)&& $zilla>0 && $zilla!=null){
                           $w_zilla="id=$zilla";
                       }else{
                           $w_zilla="isactive=true";
                       }
                       $data['zilla']=$this->CI->Model_Db->select(22,null,$w_zilla);
					   $data['columns']=array('Zilla Name');
                       break;
                   case 3:
                       if(isset($mandal)&& $mandal>0 && $mandal!=null){
                           $where="id=$mandal";
                       }else{
						   if(isset($ac)&& count($ac)>0) {
							$where="";
							foreach ($ac as $key => $value) 
							{
								if ($key>0) 
								{
									$where.= " or acid=$value";
								}else{
									$where.= "acid=$value";
								}
							}
							 
							$where.=" and isactive=true";
						   }elseif (isset($pc) && $pc>0){
							   $where="pcid=$pc and isactive=true";
						   }else{
						   	$where="isactive=true";
						   }
                       }
                       $data['mandal']=$this->CI->Model_Db->select(21,null,$where);
					   $data['columns']=array('Pc Name','Ac Name','Mandal Name');
                       break;
                   case 4:
                       if(isset($shakti)&& $shakti>0 && $shakti!=null){
                           $where="id=$shakti";
                       }else{
						   if(isset($mandal) && $mandal>0){
							   $where= "mandalid=$mandal and isactive=true";
						   }
						   elseif(isset($ac)&& count($ac)>0) {
							$where="";
							foreach ($ac as $key => $value) 
							{
								if ($key>0) 
								{
									$where.= " or acid=$value";
								}else{
									$where.= "acid=$value";
								}
							}
							 
							$where.=" and isactive=true";
						   }elseif (isset($pc) && $pc>0){
							   $where="pcid=$pc and isactive=true";
						   }else{
						   	$where="isactive=true";
						   }
                       }
                       $data['shakti']=$this->CI->Model_Db->select(24,null,$where);
					   $data['columns']=array('Pc Name','Ac Name','Mandal Name','Shaktikendra Name');
                       break;
                   case 5:
                       if(isset($booth)&& $booth>0 && $booth!=null){
                           $where="id=$booth";
                       }else{
						   if(isset($ac)&& count($ac)>0) {
							$where="";
							foreach ($ac as $key => $value) 
							{
								if ($key>0) 
								{
									$where.= " or acid=$value";
								}else{
									$where.= "acid=$value";
								}
							}
							 
							$where.=" and isactive=true";
						   }elseif (isset($pc) && $pc>0){
							   $where="pcid=$pc and isactive=true";
						   }else{
						   	$where="isactive=true";
						   }
                       }
                       $data['booth']=$this->CI->Model_Db->select(15,null,$where);
					   $data['columns']=array('Pc Name','Ac Name','Booth Name');
                       break;
                   }
           }
           return $data;
		}catch (Exception $e){
			$data['message']= $e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
		}
	}
	public function detail_report($request){
		try{
			$data=array();
			if(isset($request['txtAc'])){
				$ac=$request['txtAc'];
			}
			if(isset($request['txtPc'])){
				$pc=$request['txtPc'];
			}
			if(isset($request['txtZilla'])){
				$zilla=$request['txtZilla'];
			}
			if(isset($request['txtMandal'])){
				$mandal=$request['txtMandal'];
			}
			if(isset($request['txtShakti'])){
				$shakti=$request['txtShakti'];
			}
			if(isset($request['txtBooth'])){
				$booth=$request['txtBooth'];
			}
			if(isset($request['labelid']) && $request['labelid']>0 && $request['labelid']!=null){
				$where="";
				$labelid = $request['labelid'];
				switch ($labelid){
					case 1:
						if(isset($ac)&& count($ac)>0 && $ac!=null){
							$data['where']="tpd.masterid=4";
							
							foreach ($ac as $key => $value) 
							{
								$data['where'].=" and tpd.mastercode=$value";	
							}
							$data['header']="Ac name";
						}else if(isset($pc)&& $pc>0 && $pc!=null){
							$data['where']="tpd.masterid=2 and tpd.mastercode=$pc";
							$data['header']="Pc name";
						}else if(isset($zilla)&& $zilla>0 && $zilla!=null){
							$data['where']="tpd.masterid=3 and tpd.mastercode=$zilla";
							$data['header']="Zilla name";
						}else{
							$data['where']="";
						}
						break;
					case 2:
						if(isset($zilla)&& $zilla>0 && $zilla!=null){
							$data['where']="tpd.masterid=3 and tpd.mastercode=$zilla";
							$data['header']="Zilla name";
						}else{
							$data['where']="";
						}
						break;
					case 3:
						if(isset($mandal)&& $mandal>0 && $mandal!=null){
							$data['where']="tpd.masterid=5 and tpd.mastercode=$mandal";
							$data['header']="Mandal name";
						}else{
							if(isset($ac)&& count($ac)>0) {
								$where="";
								foreach ($ac as $key => $value) 
								{
									if ($key>0) 
									{
										$where.= " or acid=$value";
									}else{
										$where.= "acid=$value";
									}
								}
								 
								$where.=" and isactive=true";
							}elseif (isset($pc) && $pc>0){
								$where="pcid=$pc and isactive=true";
							}
							if(isset($where)){
								$mndal=$this->CI->Model_Db->select(21,null,$where);
								if($mndal){
									$mid=array();
									foreach ($mndal as $m){
										$mid[]=$m->id;
									}
									$mnid = implode(",",$mid);
									$data['where']="tpd.masterid=5 and tpd.mastercode in($mnid)";
									$data['header']="Mandal name";
								}
							}
						}
						break;
					case 4:
						if(isset($shakti)&& $shakti>0 && $shakti!=null){
							$data['where']="tpd.masterid=6 and tpd.mastercode=$shakti";
							$data['header']="Shaktikendra name";
						}else{
							if(isset($mandal) && $mandal>0){
								$where= "mandalid=$mandal and isactive=true";
							}
							elseif(isset($ac)&& $ac>0) {
								$where="";
								foreach ($ac as $key => $value) 
								{
									if ($key>0) 
									{
										$where.= " or acid=$value";
									}else{
										$where.= "acid=$value";
									}
								}
								 
								$where.=" and isactive=true";
							}elseif (isset($pc) && $pc>0){
								$where="pcid=$pc and isactive=true";
							}
							if(isset($where)){
								$sk=$this->CI->Model_Db->select(24,null,$where);
								if($sk){
									$sid=array();
									foreach ($sk as $s){
										$sid[]=$s->id;
									}
									$skid = implode(",",$sid);
									$data['where']="tpd.masterid=6 and tpd.mastercode in($skid)";
									$data['header']="Shaktikendra name";
								}
							}
						}
						break;
					case 5:
						if(isset($booth)&& $booth>0 && $booth!=null){
							$data['where']="tpd.masterid=7 and tpd.mastercode=$booth";
							$data['header']="Booth name";
						}else{
							if(isset($ac)&& count($ac)>0) {
								$where="";
								foreach ($ac as $key => $value) 
								{
									if ($key>0) 
									{
										$where.= " or acid=$value";
									}else{
										$where.= "acid=$value";
									}
								}
								 
								$where.=" and isactive=true";
							}elseif (isset($pc) && $pc>0){
								$where="pcid=$pc and isactive=true";
							}
							if(isset($where)){
								$both=$this->CI->Model_Db->select(15,null,$where);
								if($both){
									$bid=array();
									foreach ($both as $b){
										$bid[]=$b->id;
									}
									$bid = implode(",",$bid);
									$data['where']="tpd.masterid=7 and tpd.mastercode in($bid)";
									$data['header']="Booth name";
								}
							}
						}
						break;
				}
			}else{
				$data['where']="";
			}
			return $data;
		}catch (Exception $e){
			$data['message']= $e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
		}
	}
	public function count_report($request){
		try{
			$data=array();
			if(isset($request['txtAc'])){
				$ac=$request['txtAc'];
			}
			if(isset($request['txtPc'])){
				$pc=$request['txtPc'];
			}
			if(isset($request['txtZilla'])){
				$zilla=$request['txtZilla'];
			}
			if(isset($request['txtMandal'])){
				$mandal=$request['txtMandal'];
			}
			if(isset($request['txtShakti'])){
				$shakti=$request['txtShakti'];
			}
			if(isset($request['txtBooth'])){
				$booth=$request['txtBooth'];
			}
			if(isset($request['labelid']) && $request['labelid']>0 && $request['labelid']!=null){
				$where="";
				$labelid = $request['labelid'];
				switch ($labelid){
					case 1:
						if(isset($ac)&& $ac>0 && $ac!=null){
							$data['where']="masterid=4 and mastercode=$ac";
							// $data['header']="Ac name";
						}else if(isset($pc)&& $pc>0 && $pc!=null){
							$data['where']="masterid=2 and mastercode=$pc";
							// $data['header']="Pc name";
						}else if(isset($zilla)&& $zilla>0 && $zilla!=null){
							$data['where']="masterid=3 and mastercode=$zilla";
							// $data['header']="Zilla name";
						}else{
							$data['where']="";
						}
						break;
					case 2:
						if(isset($zilla)&& $zilla>0 && $zilla!=null){
							$data['where']="masterid=3 and mastercode=$zilla";
							// $data['header']="Zilla name";
						}else{
							$data['where']="";
						}
						break;
					case 3:
						if(isset($mandal)&& $mandal>0 && $mandal!=null){
							$data['where']="masterid=5 and mastercode=$mandal";
							// $data['header']="Mandal name";
						}else{
							if(isset($ac)&& $ac>0) {
								$where= "acid=$ac and isactive=true";
							}elseif (isset($pc) && $pc>0){
								$where="pcid=$pc and isactive=true";
							}
							if(isset($where)){
								$mndal=$this->CI->Model_Db->select(21,null,$where);
								if($mndal){
									$mid=array();
									foreach ($mndal as $m){
										$mid[]=$m->id;
									}
									$mnid = implode(",",$mid);
									$data['where']="masterid=5 and mastercode in($mnid)";
									// $data['header']="Mandal name";
								}
							}
						}
						break;
					case 4:
						if(isset($shakti)&& $shakti>0 && $shakti!=null){
							$data['where']="masterid=6 and mastercode=$shakti";
							// $data['header']="Shaktikendra name";
						}else{
							if(isset($mandal) && $mandal>0){
								$where= "mandalid=$mandal and isactive=true";
							}
							elseif(isset($ac)&& $ac>0) {
								$where= "acid=$ac and isactive=true";
							}elseif (isset($pc) && $pc>0){
								$where="pcid=$pc and isactive=true";
							}
							if(isset($where)){
								$sk=$this->CI->Model_Db->select(24,null,$where);
								if($sk){
									$sid=array();
									foreach ($sk as $s){
										$sid[]=$s->id;
									}
									$skid = implode(",",$sid);
									$data['where']="masterid=6 and mastercode in($skid)";
									// $data['header']="Shaktikendra name";
								}
							}
						}
						break;
					case 5:
						if(isset($booth)&& $booth>0 && $booth!=null){
							$data['where']="masterid=7 and mastercode=$booth";
							// $data['header']="Booth name";
						}else{
							if(isset($ac)&& $ac>0) {
								$where= "acid=$ac and isactive=true";
							}elseif (isset($pc) && $pc>0){
								$where="pcid=$pc and isactive=true";
							}
							if(isset($where)){
								$both=$this->CI->Model_Db->select(15,null,$where);
								if($both){
									$bid=array();
									foreach ($both as $b){
										$bid[]=$b->id;
									}
									$bid = implode(",",$bid);
									$data['where']="masterid=7 and mastercode in($bid)";
									// $data['header']="Booth name";
								}
							}
						}
						break;
				}
			}else{
				$data['where']="";
			}
			return $data;
		}catch (Exception $e){
			$data['message']= $e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
		}
	}
}
