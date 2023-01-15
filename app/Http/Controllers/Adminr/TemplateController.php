<?php

namespace App\Http\Controllers\Adminr;

use App\Http\Controllers\Controller;
use App\Models\MailTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TemplateController extends Controller
{
    public function index()
    {
        try {
            $templates = MailTemplate::when(request()->has('term') && !is_null(request()->get('term')), function ($query) {
                $query->where('subject', 'LIKE', "%" . request()->get('term') . "%")
                    ->orWhere('purpose', 'LIKE', "%" . request()->get('term') . "%")
                    ->orWhere('code', 'LIKE', "%" . request()->get('term') . "%");
            })
                ->distinct()
                ->paginate(10);

            return inertia('Adminr/MailTemplates/Index', [
                'templates' => $templates,
                'query' => request()->all(['term'])
            ]);
        } catch (\Exception | \Error $e) {
            return $this->backError('Error: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return inertia('Adminr/MailTemplates/Create');
        } catch (\Exception | \Error $e) {
            return $this->backError('Error: ' . $e->getMessage());
        }
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {

        $request->validate([
            'subject' => ['required', 'unique:mail_templates'],
            'code' => ['required', 'unique:mail_templates'],
            'content' => ['required'],
        ]);

        try {
            MailTemplate::create([
                'subject' => trim($request->get('subject')),
                'purpose' => trim($request->get('purpose')),
                'code' => Str::kebab(trim($request->get('code'))),
                'content' => $request->get('content'),
            ]);

            return $this->backSuccess('Mail template created successfully!');
        } catch (\Exception | \Error $e) {
            return $this->backError('Error: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        try {
            $template = MailTemplate::where('id', $id)->first();
            return inertia('Adminr/MailTemplates/Edit', compact('template'));
        } catch (\Exception | \Error $e) {
            return $this->backError('Error: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'subject' => ['required'],
            'content' => ['required'],
        ]);

        try {
            MailTemplate::where('id', $id)->update([
                'subject' => trim($request->get('subject')),
                'purpose' => trim($request->get('purpose')),
                'content' => $request->get('content'),
            ]);
            return $this->backSuccess('Mail template updated successfully!');
        } catch (\Exception | \Error $e) {
            return $this->backError('Error: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            MailTemplate::where('id', $id)->delete();
            return $this->backSuccess('Template deleted successfully!');
        } catch (\Exception | \Error $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
