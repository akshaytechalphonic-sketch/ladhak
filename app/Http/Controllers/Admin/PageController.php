<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::withCount('sections')->get();
        
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_name' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $page = Page::create($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }
    public function show(){
          $pages = Page::withCount('sections')->latest()->paginate(10);
     return view('admin.pages.show', compact('pages'));
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'page_name' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug,' . $page->id . '|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function showSections(Page $page)
    {
        $sections = $page->sections()->orderBy('id')->get();
        return view('admin.pages.sections', compact('page', 'sections'));
    }

    public function createSection(Page $page)
    {
        return view('admin.pages.create_section', compact('page'));
    }

    public function storeSection(Request $request, Page $page)
    {
       
        $validated = $request->validate([
            'section_name' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable',
            'status' => 'required|boolean',
            'extra_data_json' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('pages', 'public');
        }

        if ($request->filled('extra_data_json')) {
            $validated['extra_data'] = json_decode($request->extra_data_json, true);
        }

        $page->sections()->create($validated);

        return redirect()->route('admin.pages.sections', $page->id)
            ->with('success', 'Section added successfully.');
    }

    public function editSection(PageSection $section)
    {
        return view('admin.pages.edit_section', compact('section'));
    }

    public function updateSection(Request $request, PageSection $section)
    {
       
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'status' => 'required|boolean',
            'extra_data_json' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('pages', 'public');
        }

        if ($request->filled('extra_data_json')) {
            $validated['extra_data'] = json_decode($request->extra_data_json, true);
        }

        $section->update($validated);

        return redirect()->route('admin.pages.sections', $section->page_id)
            ->with('success', 'Section updated successfully.');
    }

    public function destroySection(PageSection $section)
    {
        $pageId = $section->page_id;
        $section->delete();
        return redirect()->route('admin.pages.sections', $pageId)->with('success', 'Section deleted successfully.');
    }

    public function destroy(Page $page)
    {
        // Prevent deleting Home/About as they are core
        if (in_array($page->slug, ['home', 'about-us'])) {
            return redirect()->back()->with('error', 'Core pages cannot be deleted.');
        }
        $page->sections()->delete();
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
