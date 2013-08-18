(function(){

	/**
	*
	* Module to save the data
	*
	**/
	function DataSaver() {
		this.save = function() {
			window.webkitRequestFileSystem(window.TEMPORARY, 1024*1024, function(fs) {
		        fs.root.getFile( looper.fileName, {create: true}, function(fileEntry) {
		            fileEntry.createWriter(function(fileWriter) {

		                var blob = new Blob([looper.keeper.tableArray]);

		                fileWriter.addEventListener("writeend", function() {
		                    // navigate to file, will download
		                    location.href = fileEntry.toURL();
		                }, false);

		                fileWriter.write(blob);

		            }, function() {});
		        }, function() {});
		    }, function() {});
		}
	}

	/**
	*
	* Module to keep the data until saving
	*
	**/
	function DataKeeper() {
		this.tableArray = [];
	}

	/**
	*
	* Module to process the data (extract the value from the table)
	*
	**/
	function DataProcessor(args) {
		
		this.page = args.page;
		var that = this;

		this.process = function(result) {
			var $table = $(result).filter('table#' + looper.tableId);
			$table.find('tr').each(function(){
				var rowArray = [];
				var data = $(this).find('td');
				if(data.length > 0) {
					data.each(function() {
						rowArray.push($(this).text());
					});
					rowArray.push(" / ");
					looper.keeper.tableArray.push(rowArray);
					console.log("new entry added " + that.page);
				}
			});
			if(that.page == looper.steps - 1) {
				looper.save();
			}
		};
	}

	/**
	*
	* Application's core
	* everything happens with DataLooper.loop();
	*
	**/
	function DataLooper(args) {

		this.fullUrl = args.url + "?" + args.param + "=";
		this.steps = args.steps;
		this.fileName = args.fileName + "_dg.bin";
		this.tableId = args.tableId;
		this.interval = args.interval;
		this.delay = 0;

		this.keeper = new DataKeeper();
		this.saver = new DataSaver(this.fileName);

		this.loop = function() {
			for(var i = 0; i < this.steps; i++) {
				setTimeout(function(){
					var processor = new DataProcessor({ page: i });
  					$.get(this.fullUrl + i, processor.process);
				}, this.delay);
				this.delay += this.interval;
			}
		},
		this.save = function() {
			this.saver.save();
		}
	}

	var looper = new DataLooper({
		url: 'table.php',
		param: 'page',
		steps: 10,
		tableId: 'table',
		fileName: 'data',
		interval: 1000
	});

	looper.loop();
	
})();