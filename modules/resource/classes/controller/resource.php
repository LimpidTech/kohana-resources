<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Resource extends Controller {

	/**
	 * Retreives an arbitrary resource through the view system.
	 */
	public function action_get($identifier, $config = null)
	{
		if ($config === null)
			$config = Kohana::config('resources');

		$view_response = View::factory()->render($identifier);

		if (preg_match('/(.+)\.([\w\d]{2,4})/', $identifier, $matches))
		{
			$file_name = $matches[1];
			$file_type = $matches[2];

			$view_response = $this->process($view_response, $file_type, $config);

			$this->request->headers['Content-Type'] = File::mime_by_ext($file_type);
		}

		print $view_response;
	}

	/**
	 * Retreives a resource filename for passing back to XSendfile
	 *
	 * Receives a path or collected identifier for a specific piece of media.
	 * The identifier will be looked up through the resource configuration, and
	 * if it is not found will be treated as an exact path name. Finally, we use
	 * Kohana::find_file in order to figure out which skin this file should be
	 * retreived from and the pass the filename to Apache for further processing
	 * via the X-Sendfile header.
	 *
	 * TODO: Cached results
	 * TODO: Collections
	 * TODO: Finish this by implementing the sendfile part.
	 */
	public function action_sendfile($identifier, $config = null)
	{
		if ($config === null)
			$config = Kohana::config('resources');

		if (!isset($config['collections']) || !isset($config['collections'][$identifier]))
		{
			print $this->action_get($identifier, $config);
		}
		else
		{
			// TODO: Implement collections
		}
	}

	/**
	 * Called by actions that support postprocessing.
	 *
	 * Postprocessing allows extra pieces of processing to be done to files after
	 * they have been passed their their action. The action then sends the final
	 * data through process and the processor will iterate the configuration array
	 * resources.processors and process the data through each of the processors
	 * configured for the original data's file type.
	 *
	 * This is ultimately for many different things, the most prominent being
	 * easy minifying of original files.
	 */
	private function process($data, $file_type, $config = null)
	{
		if ($config === null)
			$config = Kohana::config('resources');

			// Loop through each processor for this file type and update $data with it
		if (isset($config['processors']) && isset($config['processors'][$file_type]))
			foreach ($config['processors'][$file_type] as $processor)
				$data = Resource_Processors::$processor($data);

		return $data;
	}

}

