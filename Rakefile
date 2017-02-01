TPL = "_site/menu.html"
TST = "_includes/menu.html"

task :default => :nav

desc "Generates sidebar then copy it to be used as an include"
task :nav do

  #if !File.exist?(TST)
  #  puts "Creating dummy #{TST} file"
  #  open(TST, 'w') do |f|
  #    f.puts warning
  #  end
  #end

  # alas, there is no way to generate only a single file using Jekyll, so, we do the first iteration for the benefit of generating an up to date menu.html and then again so that all files get the updated include
  puts "Building Jekyll "
  system "jekyll build --trace"

  # delete target file (TST) if exist
  if File.exist?(TST)
      puts "#{TST} exists deleting it"
      rm TST
  end

  # copy generated file as an include
  cp(TPL, TST)
  puts "Building Jekyll AGAIN"
  system "jekyll build --trace"

  puts "task END"
end

