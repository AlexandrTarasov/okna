<!DOCTYPE html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title></title>
	<meta name="description" content="" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.quantity-selector{height: 40px;margin: 0px 7px 0 0;}
		.pointerdiv-add {
				color: white; box-shadow-color: red; background: green; border: 1px solid #9f9f9f; border-radius: 8px; font-size: 15px; font-weight: 700; box-shadow: -1px 4px 4px 2px grey; background-color: #5fb78e; position: absolute; left:0; top:-25px;
		}
		.suspention-block{width:unset;float: left;height: 210px;padding: 0;margin: 2px;border: 1px solid #bebebe; width: 294px; overflow: auto;}
		.model_select{ padding: 10px; border-radius: 5px; box-shadow: azure; background: #e8e8e8;color: #ae0101; font-size: 18px;}
		.hidden {
			display: none !important;
			visibility: hidden !important;
		}
		.row div {
		/* border-right: 1px solid #f6f6f6; */
		}
		#tooltip1{
			display: none;
		}
		#products_list .row{
			margin-bottom: 15px;
			box-shadow: 2px 3px 5px #c4c4c4;
		}
		#appear{opacity:0.1; box-shadow: 0px -1px 13px 0px #F44336; transition:opacity 1s;}
		.my {
			margin: 5px;
			width: 125px;
			padding:0;
		}
		.order-col{font-size: 17px; text-align:center; padding:0px;}
		#resSearch {
			max-width: 450px;
			min-width: 262px;
			margin-top: 2px;
			border-radius: 3px;
			border: 1px solid #bcbcbc;
			background: rgba(255, 252, 239, 0.92);
			position: absolute;
			padding: 3px;
			z-index: 11;
		}
		.part-pointer{background: rgba(255, 89, 10, 0.26); height: 25px;
			width: 25px; position: absolute;
			border-radius: 15px;
			border: 1px solid #7e7e7e;
			cursor:pointer;
			}
		.suspention-img{width:100%;}
		a.nameblock {color: #00358b; text-decoration: none; text-transform: uppercase; }
		.nameblock {text-transform: uppercase; color: #1f6473;}
		.pointer {cursor: pointer; border:1px solid #e2e2e2; display: inline-block; padding: 3px;}
		.pointer:hover{background: #dfeafa;}
		.toggle.btn {margin-bottom: 5px; }
		.pointer-div-del{ position: absolute; top: -20px; right: 10px; background: lightpink; width: 20px; height: 20px; }
		.del-title{top: -20px; position: absolute; left: -15px; color: black;}

		.phone_div{display:none;}
		.dop_cart_div{display:none;}
		label.btn-default.active{
			color: #ececec;
			background-color: #4a8c64;
			border-color: #4a8c64;
		}
		.info-sto{
			max-width: 150px; position: fixed; right: 10px; margin-top: 110px; z-index:10;
		}
			#cart_content div div{font-size:12px;}
			.spin{
				animation-name: spin1;
    animation-duration: 1000ms;
    animation-iteration-count: 1;
    animation-timing-function: linear;
			}
			@keyframes spin1 {
    from {
        transform:rotate(0deg);
    }
    to {
        transform:rotate(360deg);
    }
}

			/* span.btn{margin: 4px 12px;} */
			.molelstyle{background: #b4fae5; margin: 3px;}
			@media screen and (max-width: 1924px) {
			.warning{border-color: rgb(255, 161, 161); padding:5px;}
			}
			@media screen and (max-width: 424px) {
				.warning{max-width: 150px; position: fixed; right: 10px; z-index: 10;
					border-color: rgb(255, 161, 161); padding:5px; top: 70px;
				}
				#logo_img{height:50px;}
				#phones_ul{display:none;}
				#main_cart_div{display:none;}
				.phone_div{display:block;float:right;font-size: 18px;}
				.dop_cart_div{display:block;float:right;margin-right:25px;margin-top:15px;}
				.suspention-block{
					float: left; padding: 0; margin: 2px; border: 1px solid #bebebe; width: 294px; overflow: auto;height: 100%;
				}
			}
	</style>
	<!-- <link href="http://autoritetparts.com.ua/bootstrap&#45;3.3.7&#45;dist/css/bootstrap&#45;toggle.css" rel="stylesheet"> -->
</head>
<body>

<?=$content?>

</body>
</html>
