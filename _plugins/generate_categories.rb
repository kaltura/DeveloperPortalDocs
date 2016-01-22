require 'rbconfig'
require 'shellwords'

module Jekyll
  module CatMetadata
    class Generator < Jekyll::Generator

      safe true

      def generate(site)

        Dir.chdir(site.source) do
	  site.config['cats'] ||= {}
          site.pages.each do |page|
	    if page.name === 'categorymeta.md'
	      cat_name=page.data['catname']
	      site.config['cats'][cat_name] = File.dirname(page.path.shellescape)
	    end
          end
        end
        
      end
    end
  end
end
