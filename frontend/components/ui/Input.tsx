"use client";

import React from "react";

interface InputProps extends React.InputHTMLAttributes<HTMLInputElement | HTMLTextAreaElement> {
  label?: string;
  error?: string;
  type?: string;
  options?: { label: string; value: string | number }[]; // For radio/checkbox groups if needed
}

export default function Input({
  label,
  error,
  className = "",
  type = "text",
  id,
  ...props
}: InputProps) {
  const baseInputStyles = "w-full px-4 py-3 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white outline-none focus:ring-2 focus:ring-blue-500 transition-all placeholder:text-zinc-400";
  const errorStyles = error ? "border-red-500 focus:ring-red-500" : "";

  const renderInput = () => {
    if (type === "textarea") {
      return (
        <textarea
          id={id}
          className={`${baseInputStyles} ${errorStyles} ${className}`}
          {...(props as React.TextareaHTMLAttributes<HTMLTextAreaElement>)}
        />
      );
    }

    if (type === "checkbox" || type === "radio") {
      return (
        <div className="flex items-center gap-3 group cursor-pointer">
          <input
            id={id}
            type={type}
            className={`w-5 h-5 rounded-lg border-zinc-300 dark:border-zinc-700 text-blue-600 focus:ring-blue-500 cursor-pointer ${className}`}
            {...props}
          />
          {label && (
            <label htmlFor={id} className="text-sm font-medium text-zinc-700 dark:text-zinc-300 cursor-pointer">
              {label}
            </label>
          )}
        </div>
      );
    }

    return (
      <input
        id={id}
        type={type}
        className={`${baseInputStyles} ${errorStyles} ${className}`}
        {...props}
      />
    );
  };

  // For checkbox/radio, label is handled inside renderInput
  if (type === "checkbox" || type === "radio") {
    return (
      <div className="space-y-1">
        {renderInput()}
        {error && <p className="text-xs text-red-500 font-medium">{error}</p>}
      </div>
    );
  }

  return (
    <div className="space-y-1.5 w-full">
      {label && (
        <label htmlFor={id} className="text-sm font-bold text-zinc-700 dark:text-zinc-300">
          {label}
        </label>
      )}
      {renderInput()}
      {error && <p className="text-xs text-red-500 font-medium">{error}</p>}
    </div>
  );
}
