require 'rbconfig'
require 'shellwords'

module Jekyll
  module CatMetadata
    class Generator < Jekyll::Generator

      safe true

      def generate(site)

        Dir.chdir(site.source) do
	  site.config['cats'] ||= {}
	  site.config['subcats'] ||= {}
          site.pages.each do |page|
	    if page.name === 'categorymeta.md'
	      cat_name=page.data['catname']
	      #if page.data['subcats']
	      #	site.config['cats'][File.dirname(page.path.shellescape)] = cat_name + '::' + page.data['subcats']
	      #else
		site.config['cats'][File.dirname(page.path.shellescape)] = cat_name
	      #end

	    end
          end
        end
        
      end
    end
  end
end
